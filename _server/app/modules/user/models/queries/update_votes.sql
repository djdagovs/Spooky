UPDATE [DB_PREFIX]Game SET votes = votes + 1 WHERE gameId = :game_id LIMIT 1;