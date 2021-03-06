CREATE TABLE ResourceOwner (
	uid TEXT PRIMARY KEY,
	login TEXT NOT NULL UNIQUE,
	email TEXT NOT NULL UNIQUE,
	_data TEXT NOT NULL UNIQUE,
);

CREATE TABLE ResourceOwnerOrganisationMap (
    uid TEXT NOT NULL,
    oid TEXT NOT NULL,
    role TEXT NOT NULL
)

CREATE TABLE Organisation (
    oid TEXT PRIMARY KEY,
    _data TEXT NOT NULL
)

CREATE TABLE Token (
    token_hash TEXT PRIMARY KEY,
    valid_to INTEGER NOT NULL,
    uid TEXT NOT NULL,
    client_id TEXT NOT NULL,
    _data TEXT NOT NULL
)

CREATE TABLE Session (
   sess_id INTEGER PRIMARY KEY,
   valid_to TEXT NOT NULL UNIQUE,
   uid TEXT NOT NULL UNIQUE,
   data TEXT NOT NULL UNIQUE,
);
