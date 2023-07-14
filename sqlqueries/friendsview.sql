CREATE VIEW friendsview AS
SELECT
    u1.id AS userone_id,
    u1.username AS userone_username,
    u1.image AS userone_image,
    u2.id AS usertwo_id,
    u2.username AS usertwo_username,
    u2.image AS usertwo_image,
    f.friendsid AS friends_id,
    f.approve
FROM
    friends f
JOIN
    users u1 ON f.userone = u1.id
JOIN
    users u2 ON f.usertwo = u2.id;