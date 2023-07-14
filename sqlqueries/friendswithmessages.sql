CREATE VIEW friends_with_messages AS
SELECT
    fv.userone_id,
    fv.userone_username,
    fv.userone_image,
    fv.usertwo_id,
    fv.usertwo_username,
    fv.usertwo_image,
    fv.friends_id,
    fv.approve,
    m.message_text AS last_message,
    m.message_time,
    m.message_sender,
    m.message_view
FROM
    friendsview AS fv
    LEFT JOIN messages AS m ON fv.friends_id = m.message_friendsid
WHERE
    m.message_time = (
        SELECT MAX(message_time)
        FROM messages
        WHERE message_friendsid = fv.friends_id
    );