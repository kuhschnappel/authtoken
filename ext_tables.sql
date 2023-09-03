CREATE TABLE tx_authtoken_domain_model_token (
    note varchar(255) NOT NULL DEFAULT '',
    token varchar(255) NOT NULL DEFAULT '',
    last_access  int(10) unsigned NOT NULL DEFAULT 0,
    usage_counter  int(10) unsigned NOT NULL DEFAULT 0,
    feuser_uid int(11) unsigned NOT NULL default '0'
);

CREATE TABLE fe_users (
    tx_authtoken_domain_model_token int(11) unsigned DEFAULT '0' NOT NULL,
);
