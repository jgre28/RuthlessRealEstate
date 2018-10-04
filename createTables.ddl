-- schema s25099159 (class Schema) :(
create table authenticate
(
	userID int auto_increment comment 'unique user identifier'
		primary key,
	gName varchar(50) not null comment 'given name of the user',
	fName varchar(50) not null comment 'family name of the user',
	uName varchar(10) not null comment 'the users username',
	pword varchar(64) not null comment 'the users password',
	constraint AUTHENTICATE_uName_uindex
		unique (uName)
)
;

create table client
(
	clientID int auto_increment comment 'unique identifier for the client'
		primary key,
	gName varchar(50) not null comment 'clients given name',
	fName varchar(50) not null comment 'clients family name',
	unitNum varchar(10) null comment 'clients unit number',
	streetNum varchar(10) not null comment 'clients street number',
	street varchar(100) not null comment 'clients street name',
	suburb varchar(50) not null comment 'the clients suburb',
	state varchar(6) not null comment 'the clients state',
	postcode varchar(4) not null comment 'the clients postcode',
	email varchar(50) not null comment 'the clients email',
	mobile varchar(12) not null comment 'clients mobile number',
	mailingList char not null comment 'whether the client is on the mailing list or not'
)
;

create table feature
(
	featureID int auto_increment comment 'Unique feature ID'
		primary key,
	featureName varchar(30) not null comment 'name of the feautre in question'
)
;

create table type
(
	typeID int auto_increment comment 'Property type unique identifier'
		primary key,
	typeName varchar(30) not null comment 'the name of the property type'
)
;

create table property
(
	propertyID int auto_increment comment 'the properties unique identifier'
		primary key,
	unitNum varchar(10) null comment 'the unit number of the property',
	streetNum varchar(10) not null comment 'the street number of the property',
	street varchar(100) not null comment 'the street the property is located on',
	suburb varchar(50) not null comment 'the suburb of the property',
	state varchar(5) not null comment 'the state the property is in',
	postcode varchar(4) not null comment 'the postcode of the property',
	sellerID int not null comment 'the unique identifier for the properties seller',
	listingDate date not null comment 'the date the property was listed',
	listingPrice decimal(12,2) not null comment 'the price the property was listed for',
	saleDate date null comment 'the date the property was sold',
	salePrice decimal(12,2) null comment 'the price the property was sold for',
	imageName varchar(40) null comment 'the name of the image attached to the property',
	description varchar(200) null comment 'a brief description of the property',
	propertyType int not null comment 'property type identifier',
	constraint property_CLIENT_fk
		foreign key (sellerID) references client (clientID),
	constraint property__propertyType
		foreign key (propertyType) references type (typeID)
			on update cascade
)
;

create index property_CLIENT_fk
	on property (sellerID)
;

create index property__propertyType
	on property (propertyType)
;

create table property_feature
(
	propertyID int not null comment 'the properties unique identifier',
	featureID int not null comment 'the features unique identifier',
	description varchar(100) null comment 'a description of the specific feature',
	primary key (propertyID, featureID),
	constraint PROPERTY_FEATURE_property_fk
		foreign key (propertyID) references property (propertyID)
			on delete cascade,
	constraint PROPERTY_FEATURE_feature_fk
		foreign key (featureID) references feature (featureID)
			on delete cascade
)
;

create index PROPERTY_FEATURE_feature_fk
	on property_feature (featureID)
;

