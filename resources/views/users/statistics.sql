CREATE VIEW item_popularity AS
SELECT i.itemid as itemid, i.owner as owner, COUNT(*) AS popularity
FROM items i, posts p, bids b
WHERE i.itemid = p.item AND p.postid = b.post
GROUP BY i.itemid, i.owner;

SELECT itemid, AVERAGE(popularity)
FROM item_popularity;

SELECT u.email, AVERAGE(i.popularity)
FROM users u, item_popularity i
WHERE u.email = i.owner
GROUP BY u.email;

SELECT u.email, AVERAGE(i.popularity)
FROM users u, item_popularity i, posts p, bids b, loans loans
WHERE u.email = b.bidder AND b.bidid = l.bid AND b.post = p.postid AND p.item = i.itemid
GROUP BY u.email;