CREATE VIEW item_popularity AS
SELECT i.itemid as itemid, i.owner as owner, COUNT(*) AS popularity
FROM items i, posts p, bids b
WHERE i.itemid = p.item AND p.postid = b.post
GROUP BY i.itemid, i.owner;

SELECT itemid, AVERAGE(popularity)
FROM item_popularity;

SELECT u.email, AVERAGE(i.popularity)
FROM users u, item_popularity item
WHERE u.email = i.owner
GROUP BY u.email;