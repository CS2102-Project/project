--For markets display, select posts that don't belong to the current user
SELECT * from posts p where p.item not in (
  SELECT i.itemid from items i where i.owner = user_email
);

--Insert new entries into bids table
INSERT INTO bids (bidder, post, points) VALUES (email, postid, points);

--Transaction history
SELECT u1.username as owner, u2.username as bidder, b.points, b.updated_at as time
FROM users u1, users u2, bids b, items i, posts p
WHERE b.bidder = u2.email AND b.post = p.postid AND p.item = i.itemid AND i.onwer = u1.email
AND (b.bidder = email OR i.owner =email);

--User items average popularity
SELECT AVG(num)
FROM
(SELECT i.itemid, COUNT(b.bidid) as num
FROM posts p, bids b, items i
WHERE b.post = p.postid AND p.item = i.itemid AND i.owner = email
GROUP BY i.itemid) as derived;

--User bidding posts average popularity (error contained)
SELECT AVG(num)
FROM
(SELECT COUNT(b.bidid) as num from
(SELECT p.postid as postid
FROM posts p, bids b
WHERE p.postid = b.post and b.bidder = email) as myposts), bids b
WHERE b.post = myposts.postid) as derived;

--MAX bidding points for a specific post
SELECT MAX(b.points)
FROM bids b, posts p
WHERE b.post = p.postid AND p.postid = postid;