CREATE VIEW item_popularity AS
SELECT i.itemid as itemid, COUNT(*) AS popularity
FROM items i, posts p, bids b
WHERE i.itemid = p.item AND p.postid = b.post
GROUP BY i.itemid;

SELECT itemid, AVERAGE(popularity)
FROM item_popularity;
