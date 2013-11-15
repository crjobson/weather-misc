weather-misc
============

Weather bits and pieces

weather database uses this table:

create table weather
(
`Index` INT NOT NULL AUTOINCREMENT,
Transfer DATETIME,
Recorded DATETIME,
Reading_Interval INT,
Indoor_Humidity INT,
Indoor_Temp DECIMAL(5,1),
Outdoor_Humidity INT,
Outdoor_Temp DECIMAL(5,1),
Dew_Point DECIMAL(5,1),
Wind_Chill DECIMAL(5,1),
Abs_Pressure DECIMAL(5,1),
Rel_Pressure DECIMAL(5,1),
Wind_Avg DECIMAL(5,1),
Wind_Avg_Beaufort INT,
Wind_Gust DECIMAL(5,1),
Wind_Gust_Beaufort INT,
Wind_Direction DECIMAL(5,1),
Wind_Direction_Text VARCHAR(4),
Rain_Ticks INT,
Rain_Total DECIMAL(10,1),
Rain_Since_Last DECIMAL(10,1),
Rain_Last_Hour DECMAL(10,1),
Rain_Last_24 DECIMAL(10,1),
Rain_Last_7Days DECIMAL(10,1),
Rain_Last_30Days DECIMAL(10,1),
Rain_Last_Year DECIMAL(10,1),
Status_0 INT,
Status_1 INT,
Status_2 INT,
Status_3 INT,
Status_4 INT,
Status_5 INT,
Status_6 INT,
Status_7 INT,
Data_Address INT
)

example data:

4071, 1970-01-02 15:54:00, 2013-11-15 19:08:00, 30, 51, 19.8, 99, 2.0, 1.9, 2.0, 1034.8, 1034.8, 0.0, 0, 0.0, 0, 45.0, NE, 720, 216.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0, 0, 0, 0, 0, 0, 0, 00df60, 1E 33 C6 0 63 14 0 6C 28 0 0 0 2 D0 2 0 ,

