INSERT INTO `product` (`id`, `name`, `cost`)
VALUES (1, 'Concert 1', 1000),
       (2, 'Concert 2', 500);

INSERT INTO `discount` (`product_id`, `name`, `type`, `value`)
VALUES (1, 'Black Thursday', 'amount', 100);
