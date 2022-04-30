CREATE OR REPLACE TRIGGER update_termek
  BEFORE DELETE OR INSERT OR UPDATE ON MEGRENDEL
  FOR EACH ROW
DECLARE
    termek_szam number;
    termek_nev varchar2(200);
BEGIN
  if inserting then
select db_szam, nev into termek_szam, termek_nev from termek where nev=:new.nev for update;
if (termek_amount<:new.darab) then
       raise_application_error (-20001, 'kifogyott az '||termek_name);
end if;
update termek s set s.darabszam=s.darabszam-:new.darab
where s.nev=:new.nev;
end if;
  if updating then
update termek s set s.darabszam=s.darabszam-:new.darab+:old.darab
where s.nev=:new.nev;
end if;
  if deleting then
update termek s set s.darabszam=s.darabszam+:old.darab where s.nev=:old.nev;
end if;
END;
/