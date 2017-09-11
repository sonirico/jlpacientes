
create or replace view teams_with_players_count as
select
  t.*,
  coalesce(count(p.id)) as n_players
from
  teams as t left join players as p
on
  p.team = t.id
group by
  t.id
order by
  n_players desc,
  t.name asc
;