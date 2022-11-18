SELECT broker.name, COUNT(customer.id) AS customers
FROM broker
INNER JOIN customer ON broker.id = customer.broker_id
GROUP BY broker.id
ORDER BY customers DESC, broker.name ASC