create table items(
    _id_item primary key,
    name varchar(40) not null,
    description varchar(250) not null,
    _id_category bigint references category(_id_category)
);

create table items_category(
  _id_item bigint references items(_id_item),
  _id_category bigint references category(_id_category)
);

create table auctions(
    _id_auction primary key,
    _id_item bigint,
    posting_user_id bigint references user(_id_user),
    name varchar(15),
    description varchar(150),
    end_date date,
    top_bid float,
    top_bid_user bigint references user(_id_user)
);


create table category(
    _id_category primary key,
    name varchar(40)
);

create table user(
    _id_user primary key,
    username varchar(15),
    password varchar(20)
);