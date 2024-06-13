SELECT l.id, l.title, l.description, l.price_per_night, l.nb_room, l.nb_bed, l.nb_bath, l.nb_traveler, l.is_active, tl.label
      FROM logement AS l           
      INNER JOIN typelogement AS tl on l.`type_logement_id` = tl.`id`
      WHERE l.`is_active` = 1 LIMIT 100;