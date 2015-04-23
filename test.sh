#!/usr/bin/env bash
db='zjp2015.db'
echo $db
rm $db

sqlite3 $db < new.sql

sqlite3 $db <<EOF
insert into teams values
(5001,"team1","school1","a1","a2","a3",NULL),
(5002,"team2","school2","b1","b2","b3",NULL),
(5003,"team3","school3","c1","c2","c3",NULL),
(5004,"team4","school3","d1","d2","d3",NULL),
(5006,"中文6","中文","f","ex","e3",NULL),
(5005,"中文5","中文","e1","e2","e3",NULL);
EOF



