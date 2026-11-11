-- ─────────────────────────────────────────────────────
-- MOTUS BANK — Master Schema (Sections 2–8)
-- Money stored as INTEGER minor units (cents). Never floats.
-- ─────────────────────────────────────────────────────
SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET FOREIGN_KEY_CHECKS = 0;

-- ── Customers ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS customers (
    id                BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    uuid              CHAR(36) NOT NULL UNIQUE,
    first_name        VARCHAR(80)  NOT NULL,
    middle_name       VARCHAR(80)  NULL,
    last_name         VARCHAR(80)  NOT NULL,
    email             VARCHAR(190) NOT NULL UNIQUE,
    phone             VARCHAR(40)  NOT NULL,
    country           VARCHAR(80)  NOT NULL,
    address           VARCHAR(255) NULL,
    dob               DATE         NULL,
    password_hash     VARCHAR(255) NOT NULL,
    status            ENUM('pending','active','restricted','suspended','closed')
                      NOT NULL DEFAULT 'active',
    language          VARCHAR(8)   NOT NULL DEFAULT 'en',
    email_verified_at DATETIME     NULL,
    failed_logins     SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    locked_until      DATETIME     NULL,
    session_version   INT UNSIGNED NOT NULL DEFAULT 1,
    created_at        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status  (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB;

-- ── Accounts ──────────────────────────────────────────
CREATE TABLE IF NOT EXISTS accounts (
    id              BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    customer_id     BIGINT UNSIGNED NOT NULL,
    account_number  VARCHAR(20) NOT NULL UNIQUE,
    type            ENUM('checking','savings') NOT NULL DEFAULT 'checking',
    currency        CHAR(3) NOT NULL DEFAULT 'USD',
    status          ENUM('active','restricted','frozen','closed') NOT NULL DEFAULT 'active',
    available_minor BIGINT NOT NULL DEFAULT 0,
    reserved_minor  BIGINT NOT NULL DEFAULT 0,
    current_minor   BIGINT NOT NULL DEFAULT 0,
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_accounts_customer FOREIGN KEY (customer_id)
        REFERENCES customers(id) ON DELETE CASCADE,
    INDEX idx_customer (customer_id)
) ENGINE=InnoDB;

-- ── Admins ────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS admins (
    id              BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    username        VARCHAR(60)  NOT NULL UNIQUE,
    email           VARCHAR(190) NOT NULL UNIQUE,
    password_hash   VARCHAR(255) NOT NULL,
    role            ENUM('super','admin','support') NOT NULL DEFAULT 'support',
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    failed_logins   SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    locked_until    DATETIME NULL,
    session_version INT UNSIGNED NOT NULL DEFAULT 1,
    must_change_pw  TINYINT(1) NOT NULL DEFAULT 0,
    last_login_at   DATETIME NULL,
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ── Password resets ───────────────────────────────────
CREATE TABLE IF NOT EXISTS password_resets (
    id          BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_type   ENUM('customer','admin') NOT NULL,
    user_id     BIGINT UNSIGNED NOT NULL,
    token_hash  CHAR(64) NOT NULL,
    expires_at  DATETIME NOT NULL,
    used_at     DATETIME NULL,
    ip          VARCHAR(45) NULL,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_lookup  (user_type, user_id, token_hash),
    INDEX idx_expires (expires_at)
) ENGINE=InnoDB;

-- ── Login attempts (rate limit + audit) ───────────────
CREATE TABLE IF NOT EXISTS login_attempts (
    id         BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_type  ENUM('customer','admin') NOT NULL,
    identifier VARCHAR(190) NOT NULL,
    ip         VARCHAR(45) NOT NULL,
    success    TINYINT(1) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_lookup (user_type, identifier, created_at)
) ENGINE=InnoDB;

-- ── Terms acceptance ──────────────────────────────────
CREATE TABLE IF NOT EXISTS terms_acceptances (
    id            BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    customer_id   BIGINT UNSIGNED NOT NULL,
    terms_version VARCHAR(20) NOT NULL,
    ip            VARCHAR(45) NULL,
    accepted_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_terms_customer FOREIGN KEY (customer_id)
        REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;