DROP TABLE KOMMENT;
DROP TABLE TORZSVASARLO;
DROP TABLE KEDVENCEK;
DROP TABLE SZAMLA;
DROP TABLE MEGRENDELES;
DROP TABLE KOSAR;
DROP TABLE TERMEK;
DROP TABLE FELHASZNALO;
DROP TABLE ADMIN;
DROP TABLE KATEGORIA;

-- A Kateg�ria t�bla attrib�tumai: ID, N�v

create table KATEGORIA(
    kategoria VARCHAR2(40) PRIMARY KEY NOT NULL

);


-- A Admin t�bla attrib�tumai: Admin_n�v, Admin_jelsz�

create table ADMIN(
                      admin_nev VARCHAR2(40) PRIMARY KEY NOT NULL,
                      admin_jelszo VARCHAR2(20)

);

--A User t�bla attrib�tumai: Fel_n�v, Jelszo, N�v, Lakc�m, Sz�l_datum, Email, Bankkartya, Login

create table FELHASZNALO(
                            fel_nev VARCHAR2(20) PRIMARY KEY NOT NUll,
                            jelszo VARCHAR2(21) NOT NUll,
                            nev VARCHAR2(40),
                            lakcim VARCHAR2(40),
                            szul_datum DATE,
                            email VARCHAR2(40) NOT NUll,
                            bankkartya NUMBER(38) NOT NULL

);



-- A Term�k t�bla attrib�tumai: T_k�d, n�v, db_sz�m, �r, ID
create table TERMEK(
                       t_kod VARCHAR2(40) PRIMARY KEY NOT NULL,
                       ar NUMBER(38),
                       nev VARCHAR2(40) UNIQUE NOT NULL,
                       db_szam NUMBER(38) NOT NULL,
                       kategoria  VARCHAR2(40),
                       FOREIGN KEY(kategoria) REFERENCES KATEGORIA(KATEGORIA)
);

-- A Kos�r t�bla attrib�tumai: Fel_nev, Id�pont, �r, K_db_sz�m, T_k�d, Check (T�rzsv�s�rl�-e bool), elerheto(elerheto-e)

create table KOSAR(
                      fel_nev VARCHAR2(20),
                      idopont DATE,
                      ar NUMBER(38),
                      k_db_szam NUMBER(38),
                      t_kod VARCHAR2(20),
                      check_ NUMBER(1),
                      elerheto NUMBER(1),
                      FOREIGN KEY(fel_nev) REFERENCES FELHASZNALO(FEL_NEV),
                      FOREIGN KEY(t_kod) REFERENCES TERMEK(T_KOD)
);

-- A Megrendeles t�bla attrib�tumai: M_ID, Fel_nev, D�tum, K_�r, Check_db, T_k�d, �llapot


create table MEGRENDELES(
                            m_id NUMBER(38) PRIMARY KEY NOT NULL,
                            fel_nev VARCHAR2(40),
                            datum DATE,
                            k_ar NUMBER(38),
                            check_db NUMBER(38),
                            t_kod VARCHAR2(40),
                            allapot VARCHAR2(40),
                            FOREIGN KEY(fel_nev) REFERENCES FELHASZNALO(FEL_NEV),
                            FOREIGN KEY(t_kod) REFERENCES TERMEK(T_KOD)
);

-- A Sz�mla t�bla attrib�tumai: M_ID, Fel_n�v, Kelte, SZ_ID

create table SZAMLA(
                       m_id NUMBER(38),
                       fel_nev VARCHAR2(40),
                       kelte DATE,
                       sz_id NUMBER(38) PRIMARY KEY NOT NULL,
                       FOREIGN	KEY(m_id) REFERENCES MEGRENDELES(M_ID),
                       FOREIGN KEY(fel_nev) REFERENCES FELHASZNALO(FEL_NEV)
);

-- A Kedvencek t�bla attrib�tumai: ID, T_K�d, Megrendelt_db


create table KEDVENCEK(
                          kategoria VARCHAR2(40) NOT NULL,
                          t_kod VARCHAR2(40),
                          megrendelt_db NUMBER(38),
                          FOREIGN KEY(kategoria) REFERENCES KATEGORIA(KATEGORIA),
                          FOREIGN KEY(t_kod) REFERENCES TERMEK(T_KOD)

);



-- A T�rzsv�s�rl� t�bla attr�b�tuma: kedvezm�ny (bool)

create table TORZSVASARLO(
                             kedvezmeny NUMBER(1),
                             fel_nev VARCHAR2(20),
                             FOREIGN KEY(fel_nev) REFERENCES FELHASZNALO(FEL_NEV)
);

-- A Comment t�bla attrib�tumai: T_k�d, Fel_n�v, D�tum

create table KOMMENT(
                        Azon NUMBER(20) PRIMARY KEY NOT NULL,
                        nev VARCHAR2(40),
                        fel_nev VARCHAR2(40),
                        komment VARCHAR2(1000),
                        datum_comment DATE,
                        FOREIGN KEY(nev) REFERENCES TERMEK(NEV),
                        FOREIGN KEY(fel_nev) REFERENCES FELHASZNALO(FEL_NEV)
);

--kategoria
INSERT INTO Kategoria VALUES('Edesseg');
INSERT INTO Kategoria VALUES('Uditok');
INSERT INTO Kategoria VALUES('Pekaru');
INSERT INTO Kategoria VALUES('Alkoholos italok');
INSERT INTO Kategoria VALUES('Husok');
INSERT INTO Kategoria VALUES('Tejtermek');
INSERT INTO Kategoria VALUES('Kert');
INSERT INTO Kategoria VALUES('Ferfi ruhazat');
INSERT INTO Kategoria VALUES('Noi ruhazat');

--�dess�g
INSERT INTO Termek VALUES('835555917','500','Sport csoki','200','Edesseg');
INSERT INTO Termek VALUES('987664321','5000','Nuttela','1000','Edesseg');
INSERT INTO Termek VALUES('100000000','100','Nyal�ka','100','Edesseg');
INSERT INTO Termek VALUES('100000001','4500','�dess�g kos�r','10','Edesseg');
INSERT INTO Termek VALUES('858868509','700','Feh�r csoki','50','Edesseg');
INSERT INTO Termek VALUES('100000024','210','Milka eg�sz mogyor�s','30','Edesseg');
--�dit�
INSERT INTO Termek VALUES('100000002','450','Coca Cola','1000','Uditok');
INSERT INTO Termek VALUES('100000010','499','Fanta','23','Uditok');
INSERT INTO Termek VALUES('100568010','479','Pepsi','30','Uditok');
INSERT INTO Termek VALUES('106550010','489','7up','25','Uditok');
--p�k�ru
INSERT INTO Termek VALUES('959492561','22','Vizes zsemle','100','Pekaru');
INSERT INTO Termek VALUES('725342049','25','Tejes kifli','80','Pekaru');
INSERT INTO Termek VALUES('363421744','99','Baugette','40','Pekaru');
INSERT INTO Termek VALUES('407074484','250','Kak�s csiga','35','Pekaru');
INSERT INTO Termek VALUES('100000003','501','Csokis f�nk','20','Pekaru');
--alkoholos italok
INSERT INTO Termek VALUES('322035247','9000','Tokaji asz�','10','Alkoholos italok');
INSERT INTO Termek VALUES('485948820','15000','Johhny Walker','10','Alkoholos italok');
INSERT INTO Termek VALUES('478765428','12000','T�rley Pezsg� �des','5','Alkoholos italok');
INSERT INTO Termek VALUES('453178555','14000','Villa Rustica','8','Alkoholos italok');
INSERT INTO Termek VALUES('100000011','2352','Ros� bor','123','Alkoholos italok');
INSERT INTO Termek VALUES('100000012','23152','Glensfiddich','24','Alkoholos italok');
INSERT INTO Termek VALUES('100000013','12251','Jack Daniels Single barrel','2','Alkoholos italok');
INSERT INTO Termek VALUES('100056987','46526','Macalan 30','5','Alkoholos italok');
INSERT INTO Termek VALUES('100365489','65443','Macallan 35','2','Alkoholos italok');
--h�s
INSERT INTO Termek VALUES('75358149','3500','Marha comb','124','Husok');
INSERT INTO Termek VALUES('863057879','1500','Diszn� dar�lt h�s','12','Husok');
INSERT INTO Termek VALUES('69368791','2100','Kacsa comb','100','Husok');
INSERT INTO Termek VALUES('564821566','6001','Pick szal�mi','12','Husok');
INSERT INTO Termek VALUES('100000004','234','Virsli','100','Husok');
INSERT INTO Termek VALUES('100000005','1000','Tarja','30','Husok');
INSERT INTO Termek VALUES('100000015','2356','Kolb�sz','2000','Husok');
INSERT INTO Termek VALUES('100000023','4501','Kacsa pecsenye','3','Husok');
--tejterm�k
INSERT INTO Termek VALUES('37639232','399','2.8% zs�tartalm� tej','100','Tejtermek');
INSERT INTO Termek VALUES('100000025','430','Lakt�zmentes tej','300','Tejtermek');
INSERT INTO Termek VALUES('702639322','1500','Trappista sajt','500','Tejtermek');
INSERT INTO Termek VALUES('840423575','4300','Cheddar sajt','100','Tejtermek');
--kert
INSERT INTO Termek VALUES('609805672','6000','Kapa','100','Kert');
INSERT INTO Termek VALUES('37180702','35000','Funyiro','10','Kert');
INSERT INTO Termek VALUES('94141745','20000','Csakany','16','Kert');
INSERT INTO Termek VALUES('100000016','23634','Locsolo rendszer','10','Kert');
INSERT INTO Termek VALUES('100000018','65444','Kerti butor szett','5','Kert');
INSERT INTO Termek VALUES('100000020','3256','Kerti torpe','1','Kert');
--ferfiruhazat
INSERT INTO Termek VALUES('509314985','2500','Slim ing t�bb sz�nben S/M/L/XL/XXL','60','Ferfi ruhazat');
INSERT INTO Termek VALUES('845703297','1700','F�rfi f�rd�nadr�g S/M/L/XL/XXL','6','Ferfi ruhazat');
INSERT INTO Termek VALUES('959762445','200','Zokni','60','Ferfi ruhazat');
INSERT INTO Termek VALUES('785377340','1200','F�rfi als� nem� S/M/L/XL/XXL','6','Ferfi ruhazat');
INSERT INTO Termek VALUES('100000014','6452','Farmer f�rfi','30','Ferfi ruhazat');
INSERT INTO Termek VALUES('100000021','9876','Kapucnis pull�ver ','2','Ferfi ruhazat');
--noiruhazat
INSERT INTO Termek VALUES('100000006','2501','Farmer k�k','2','Noi ruhazat');
INSERT INTO Termek VALUES('100000007','2314','Bl�z','20','Noi ruhazat');
INSERT INTO Termek VALUES('100000008','3200','R�vid hossz� szoknya','231','Noi ruhazat');
INSERT INTO Termek VALUES('100000009','8000','Pul�ver','240','Noi ruhazat');
INSERT INTO Termek VALUES('100000022','5432','N�i cip�','20','Noi ruhazat');



--User
INSERT INTO FELHASZNALO VALUES('BGyorgy','szegeny','Balotay Gy�rgy', '1108 Budapest G�zmozdony utca 16', '', 'bgeorge66@gmail.com', 5580107117596718);
INSERT INTO FELHASZNALO VALUES('Coneflower','m55w6RyIykhcP6AO2Osy','Brown Sharon','Becklow  Tunnel, 9921','','Sharon_Brown2873@tonsy.org', 5251229787505205);
INSERT INTO FELHASZNALO VALUES('African Violet','4mVWAgmrYKchD0ISBFmZ','Knight Candice','Bel   Tunnel, 1106','','Candice_Knight608@liret.org', 5373040081575478);
INSERT INTO FELHASZNALO VALUES('Alstroemeria','SJonq5NBznCgfEv8OMDG','Bell William','Fairholt   Drive, 1965','','William_Bell2802@irrepsy.com', 5147883396657969);
INSERT INTO FELHASZNALO VALUES('Ambrosia','50lhHs04FgwVgWZ1KCGf','Gilmour Julius','Clarks  Street, 3376','','Julius_Gilmour1509@bretoux.com', 5512888212950073);
INSERT INTO FELHASZNALO VALUES('Apple','12HtYWcmdP3AQzHB2Ajz','Little Catherine','Howard Pass, 2650','','Catherine_Little1536@fuliss.net', 5539115033863387);
INSERT INTO FELHASZNALO VALUES('Apricot','qabPUoKACJxGZNmGcfYh','Glass Emerald','Battis   Lane, 2349','','Emerald_Glass7555@bungar.biz', 5222216491057926);
INSERT INTO FELHASZNALO VALUES('Arrowwood','ddlcaMKgxwjVTBHisAhU','Tate Lexi','Camdale  Drive, 6842','','Lexi_Tate939@cispeto.com', 5436684569538717);
INSERT INTO FELHASZNALO VALUES('Aspen','M7ZxVUsmedZKjaW9bvyP','Lewin Chuck','Gathorne   Way, 1593','','Chuck_Lewin7388@kideod.biz', 5428772633251225);
INSERT INTO FELHASZNALO VALUES('Banyan','98e7sGTx92lfp0dbKvPK','Pearce Alex','Sheringham   Hill, 5586','','Alex_Pearce3269@sveldo.biz', 5569895754355183);
INSERT INTO FELHASZNALO VALUES('Baobab','vypkynIBYvgYjKV0rSwZ','Hilton Rick','Carlisle  Vale, 6926','','Rick_Hilton9772@gmail.com', 5267784308707864);
INSERT INTO FELHASZNALO VALUES('Bearberry','DVUeE0EPTWIErGihBHTw','Knight Erin','Garfield Rue, 9115','','Erin_Knight3742@tonsy.org', 5548827093543399);
INSERT INTO FELHASZNALO VALUES('Bee Balm Flower','ZvBqDcWClHd5f6SUrYNR','Johnson Hayden','Chandos  Route, 5151','','Hayden_Johnson5722@iatim.tech', 5463345480359296);
INSERT INTO FELHASZNALO VALUES('Bellflower','AC2GnOQJ2YiufqhlGyOJ','Davies Rocco','Catherine  Alley, 6923','','Rocco_Davies8535@tonsy.org', 5449828256542343);
INSERT INTO FELHASZNALO VALUES('Bilberry','An9wkC9P31YyLxxqZOHS','Saunders Drew','Walnut Alley, 4193','','Drew_Saunders5114@joiniaa.com', 5549730291240918);
INSERT INTO FELHASZNALO VALUES('Bindweed','4bJNelS23HYCIgwuznZO','Uttley Alexander','Church Tunnel, 6221','','Alexander_Uttley6598@liret.org', 5274335440202263);
INSERT INTO FELHASZNALO VALUES('Birch','394BWvRMXzwllsROk6ax','Holmes Chris','Walnut Vale, 6431','','Chris_Holmes9845@deavo.com', 5315055570679616);
INSERT INTO FELHASZNALO VALUES('Bleeding Heart','on8DdDlii2UGWXn1kiZS','Carter Bernadette','Victoria Rise Pass, 1962','','Bernadette_Carter6023@ovock.tech', 5423236534234248);
INSERT INTO FELHASZNALO VALUES('Bluebonnet','kzXJPIwq9PncUrx9ZaAF','Campbell Johnny','Charnwood   Avenue, 5907','','Johnny_Campbell4220@bungar.biz', 5282284377442882);
INSERT INTO FELHASZNALO VALUES('Bramble','3zQ1jKquI3pqlSal1fl9','Gordon Nicholas','Dunstans  Pass, 6917','','Nicholas_Gordon268@jiman.org', 5256676933123132);
INSERT INTO FELHASZNALO VALUES('Butterfly weed','6eJBX3TdJoyPMff2G3CE','Purvis Chester','Arundel   Alley, 5522','','Chester_Purvis9063@twipet.com', 5138284496129861);
INSERT INTO FELHASZNALO VALUES('Cabbage','WEmzkFMTIf9zItiNSJyL','Dubois Luke','East Road, 1986','','Luke_Dubois843@gembat.biz', 5220350290162140);
INSERT INTO FELHASZNALO VALUES('Cactus','6wwvPMwkNhkdO48uQGE7','Thomson Zara','King Edward  Grove, 3109','','Zara_Thomson6772@grannar.com', 5103770332699787);
INSERT INTO FELHASZNALO VALUES('California sycamore','jyN4E03zlzKx7v8U9oBV','Bright Aiden','Fair Walk, 2290','','Aiden_Bright5285@nickia.com', 5183796614688332);
INSERT INTO FELHASZNALO VALUES('Calla Lily','4BpVNFV5PIPdvJE6Lp2i','Watson Gabriel','Bel   Lane, 3346','','Gabriel_Watson8541@muall.tech', 5490940567347615);
INSERT INTO FELHASZNALO VALUES('Candytuft','4cMhteaGvR00aLb6pgmF','Mcnally Sonya','Canon Avenue, 1886','','Sonya_Mcnally5351@jiman.org', 5257445631608771);
INSERT INTO FELHASZNALO VALUES('Carrot','9Dj2Vc8xUFTOeOoTcvhe','Dubois Lorraine','Rivervalley Hill, 8058','','Lorraine_Dubois2951@kideod.biz', 5309846525687359);
INSERT INTO FELHASZNALO VALUES('Catmint','zpIugy8DYW0wpzCndqNn','Camden Livia','Clerkenwell Tunnel, 578','','Livia_Camden5608@womeona.net', 5230837097650705);
INSERT INTO FELHASZNALO VALUES('Chamomile','dB4S0aeW8idROb1ejyTQ','Watson Brad','Dunstable   Grove, 6449','','Brad_Watson5870@acrit.org', 5362031869881041);
INSERT INTO FELHASZNALO VALUES('Cherry','aDA2aWej9WgZn7dELtQ3','Andrews Aiden','Chatfield  Street, 1001','','Aiden_Andrews1349@qater.org', 5103126313227561);
INSERT INTO FELHASZNALO VALUES('Chestnut','3bV9ufC4qxzd5Om73zn0','Kennedy Rufus','Longleigh   Hill, 6910','','Rufus_Kennedy9948@mafthy.com', 5267579250986593);
INSERT INTO FELHASZNALO VALUES('Chinese Evergreen','hYMpB4HOWPzVWtDRaWGS','Robinson Brad','Lincoln Hill, 1309','','Brad_Robinson3465@tonsy.org', 5475494961294543);
INSERT INTO FELHASZNALO VALUES('Clarkia','9v8iRgSHoc1aVD9IWbTK','Michael Nate','Fair Rue, 1896','','Nate_Michael1828@mafthy.com', 5560898503522045);
INSERT INTO FELHASZNALO VALUES('Collard','XXDGjyHHTHT5BhlFgZ0F','Sherry Nick','Blackall   Alley, 2896','','Nick_Sherry1663@eirey.tech', 5540593780725008);
INSERT INTO FELHASZNALO VALUES('Columbine','ms92F05EG2fUUqr1f9xa','Preston Lara','Boldero   Rue, 3341','','Lara_Preston9644@grannar.com', 5243510053725036);
INSERT INTO FELHASZNALO VALUES('Cornflower','0kPnAFj32SrHzgucTf2d','Saunders Aisha','Camberwell  Avenue, 2144','','Aisha_Saunders5685@cispeto.com', 5509537514879770);
INSERT INTO FELHASZNALO VALUES('Cotton plant','xoFppy7ipp4A99XUAMZ8','Norton Rae','Ellerslie Alley, 8381','','Rae_Norton3152@gembat.biz', 5203455949895650);
INSERT INTO FELHASZNALO VALUES('Cucumber','M78FLaPgbfPoFBI1HC5G','Holt Valerie','Gatonby   Grove, 2502','','Valerie_Holt6204@deavo.com', 5209747180143939);
INSERT INTO FELHASZNALO VALUES('Cup Flower','GwX0OqC5cRTo9HcnCwDy','Addley Phillip','Angel  Drive, 7997','','Phillip_Addley5568@sveldo.biz', 5367815527172818);
INSERT INTO FELHASZNALO VALUES('Daisy','CkWzpi4AjtjgCN8ag4aZ','Griffiths Juliet','King Edward  Route, 1622','','Juliet_Griffiths331@gompie.com', 5334376805470101);
INSERT INTO FELHASZNALO VALUES('Dindle','2calIvD3Pp3dVPSmyKIb','Samuel Caleb','St. Johs  Hill, 5789','','Caleb_Samuel4532@yahoo.com', 5150820875245597);
INSERT INTO FELHASZNALO VALUES('Dogwood','1Fy7qEJSacieRpVJ91Ux','Hastings Erick','Bendall   Boulevard, 8536','','Erick_Hastings4831@atink.com', 5118099243501046);
INSERT INTO FELHASZNALO VALUES('Drumstick','3q1uhZF2sToc148FoKmO','Dubois Aiden','Bacon  Road, 6937','','Aiden_Dubois410@twace.org', 5408636553058221);
INSERT INTO FELHASZNALO VALUES('Dumb Cane','EDAlnLaYE77SVCzoYrSt','Olson Clarissa','Geary   Lane, 1525','','Clarissa_Olson1465@grannar.com', 5114984636976000);
INSERT INTO FELHASZNALO VALUES('Easter orchid','DOJBKx13eglLeAzepOTM','Jordan Aileen','Dunton  Tunnel, 789','','Aileen_Jordan2511@jiman.org', 5147636810734040);
INSERT INTO FELHASZNALO VALUES('Elephant Ear','0oo6BigXL8yx5RzGAsgY','Bailey Norah','Cliff  Road, 6216','','Norah_Bailey3363@kideod.biz', 5389482602783268);
INSERT INTO FELHASZNALO VALUES('Eucalyptus','7breco1kqAcz71OY9eI5','Sherry Alan','Ensign   Way, 2891','','Alan_Sherry4990@nickia.com', 5363788442690509);
INSERT INTO FELHASZNALO VALUES('Fennel','C8lWuF9L8tYElzgAdlDU','Hardwick Matt','Underwood  Alley, 4947','','Matt_Hardwick9810@deavo.com', 5139513306788311);
INSERT INTO FELHASZNALO VALUES('Fig','oPFNUyfLocErYWe1Z1UJ','Exton Kurt','Lexington Walk, 4047','','Kurt_Exton9356@supunk.biz', 5475306587877388);
INSERT INTO FELHASZNALO VALUES('Filipendula','epZtopJY5YwzKmuFGjMn','Mitchell Jayden','East Vale, 4542','','Jayden_Mitchell7838@gompie.com', 5464790845328818);
INSERT INTO FELHASZNALO VALUES('Gillyflower','kEmA8yP7Fu5s5l4hxiu6','Mann Chuck','Howard Crossroad, 3276','','Chuck_Mann5680@supunk.biz', 5234009749396576);
INSERT INTO FELHASZNALO VALUES('Ginseng','hHSrHyrEDMTMVKAlNR8X','Bloom Brad','Ben   Pass, 3587','','Brad_Bloom3765@typill.biz', 5289734824488592);
INSERT INTO FELHASZNALO VALUES('Goldenglow','8l33nvkFfb6ihQ1u8qdS','Tate Alma','Emden   Boulevard, 6704','','Alma_Tate6192@mafthy.com', 5101686827256044);
INSERT INTO FELHASZNALO VALUES('Grapefruit','abk5oKaTs5jmCN33m5X6','Powell Jane','Monroe Crossroad, 9222','','Jane_Powell6183@twipet.com', 5311938937629446);
INSERT INTO FELHASZNALO VALUES('Groundberry','DeRvcmpfiNNE7PE0Wyu1','Janes Tony','Carlisle  Crossroad, 8887','','Tony_Janes5@tonsy.org', 5320958209033456);
INSERT INTO FELHASZNALO VALUES('Guaco','3mq4Qrt7u9PbGor6cvNw','Archer Karla','Blenkarne  Vale, 9173','','Karla_Archer7084@guentu.biz', 5108409996901255);
INSERT INTO FELHASZNALO VALUES('Hedge plant','6dScZ6KjFwdWilMoTjTL','Lunt Jack','Virgil   Rue, 5508','','Jack_Lunt9697@naiker.biz', 5503251550796015);
INSERT INTO FELHASZNALO VALUES('Huckleberry','bemxOPkPkWq8w4OWf953','Thornton Alan','Fairfield  Road, 4398','','Alan_Thornton304@guentu.biz', 5148455115733089);
INSERT INTO FELHASZNALO VALUES('Indian paintbrush','3E1rJ3IziF3s08WFsy80','Neal Chuck','Wager   Drive, 8498','','Chuck_Neal5879@twace.org', 5339042482965772);
INSERT INTO FELHASZNALO VALUES('Ironwood','DRjeZ8Z5vqQdhmvVGfkM','Bailey Elijah','Wager   Alley, 7934','','Elijah_Bailey9635@bretoux.com', 5311022380585908);
INSERT INTO FELHASZNALO VALUES('Japanese Iris','iDGj0wBpByTbSv8phrvB','Simpson Sarah','Carpenter Grove, 6644','','Sarah_Simpson3782@mafthy.com', 5103188977237922);
INSERT INTO FELHASZNALO VALUES('Kauila','OQZBXenxgAXl1AULgREg','Grady Tyler','Heritage Route, 9421','','Tyler_Grady835@nimogy.biz', 5261034318903079);
INSERT INTO FELHASZNALO VALUES('Kentia Palm Plant','1vXlj2GN1PH6P3Gs8e2u','Ellis Priscilla','Howard Way, 74','','Priscilla_Ellis5965@infotech44.tech', 5437594015819430);
INSERT INTO FELHASZNALO VALUES('Lily','n1o3HrV6oGd7XdlupFdy','Stewart Mina','Howard Drive, 7801','','Mina_Stewart3481@womeona.net', 5281536336441425);
INSERT INTO FELHASZNALO VALUES('Lucky Bamboo','JCRmvXJFNUb1L5Be0fj2','Campbell Raquel','Blue Anchor  Way, 2958','','Raquel_Campbell2749@gembat.biz', 5481016816771201);
INSERT INTO FELHASZNALO VALUES('Manzanita','k84Vq7nbB8MWvNfnTqUV','Mooney George','Caslon   Pass, 9696','','George_Mooney5870@grannar.com', 5317688577125262);
INSERT INTO FELHASZNALO VALUES('Mesquite','bYcu1k6TAlw2ANqP27Sr','Moore Agnes','Vincent  Walk, 523','','Agnes_Moore5640@gmail.com', 5520551786009706);
INSERT INTO FELHASZNALO VALUES('Millet','frkguufJvLZg0sjpwsxH','Wilton Aiden','Chesterfield  Boulevard, 6122','','Aiden_Wilton1179@joiniaa.com', 5124702869884941);
INSERT INTO FELHASZNALO VALUES('Mistletoe','626URNQ1dXj8vtgPN5MF','Garner Samantha','Egerton  Walk, 7984','','Samantha_Garner63@dionrab.com', 5300463298117173);
INSERT INTO FELHASZNALO VALUES('Morning Glory','74gpVJwlcFA1TeD5DaQz','Sheldon Bree','Abourne   Road, 1102','','Bree_Sheldon2942@muall.tech', 5171172079675350);
INSERT INTO FELHASZNALO VALUES('Mugwort','GnLNVrkvjfUViHhTf6EY','Baker Carl','Blackall   Rue, 3265','','Carl_Baker7329@yahoo.com', 5508889826337356);
INSERT INTO FELHASZNALO VALUES('Narcissus','FXYrwq3CTYAe9UkUp1hV','Haines Catherine','Caldwell   Alley, 3276','','Catherine_Haines7727@dionrab.com', 5541978038821031);
INSERT INTO FELHASZNALO VALUES('Nemesia','EpjAKTkB8a69dG30XNun','Bradshaw Sloane','Berry  Crossroad, 8074','','Sloane_Bradshaw4296@irrepsy.com', 5250329477191075);
INSERT INTO FELHASZNALO VALUES('Pansy','hQJ9V4UEwqMTMr36TdIC','Drummond Melania','Gathorne   Lane, 1433','','Melania_Drummond7549@nickia.com', 5559182612385773);
INSERT INTO FELHASZNALO VALUES('Periwinkle','dOWMqxn9e36itM8ZmWjs','Gaynor Carla','Arbutus   Rue, 2129','','Carla_Gaynor1833@vetan.org', 5449007893504699);
INSERT INTO FELHASZNALO VALUES('Poppy','JYcqphFDCNoakHyyR0hc','Tait Erick','Comet House  Pass, 3890','','Erick_Tait9241@vetan.org', 5146427523997921);
INSERT INTO FELHASZNALO VALUES('Red Hot Poker Plant','rHTb49vHxtptlEa6yiMd','Giles Hank','Lake Alley, 7328','','Hank_Giles396@mafthy.com', 5572741753278239);
INSERT INTO FELHASZNALO VALUES('Rose','LBhabSMXm7w3z3Xfz5EC','Gallacher Harry','Timothy  Street, 8869','','Harry_Gallacher4557@deavo.com', 5419780209680892);
INSERT INTO FELHASZNALO VALUES('Shasta Daisy','bRyQZ66yH2fXdl13RtWm','Baker Marina','Pine Grove, 760','','Marina_Baker3900@joiniaa.com', 5584373998381424);
INSERT INTO FELHASZNALO VALUES('Silene','XNCnQjHWd7IPmJX2gkpf','Redfern Sasha','Spruce Drive, 5431','','Sasha_Redfern6812@joiniaa.com', 5338230484810127);
INSERT INTO FELHASZNALO VALUES('Snowflake','yYj1O8oTKh1oxVnA4Nl4','Stone Anais','Champion  Grove, 4482','','Anais_Stone2091@bulaffy.com', 5583209700978563);
INSERT INTO FELHASZNALO VALUES('Soapwort','Yw3DLvYSsZ2ivoH83qfH','Marshall Jackeline','Cadogan  Walk, 4334','','Jackeline_Marshall8094@extex.org', 5304243727390856);
INSERT INTO FELHASZNALO VALUES('Tulip','LTjJjabQsTyq1R6tjFXY','Egerton Peter','Beatty  Walk, 1201','','Peter_Egerton5863@typill.biz', 5525596014782835);
INSERT INTO FELHASZNALO VALUES('Urn Plant','8eMhFSgQzy8LmmKTCLik','Taylor Julian','Linden Pass, 5844','','Julian_Taylor3042@womeona.net', 5430368774694996);
INSERT INTO FELHASZNALO VALUES('Vervain','YLafutlZ4scYQeOPq4Ws','Bell Denis','Bellenden  Way, 8993','','Denis_Bell227@brety.org', 5171928408553109);

--Admin
INSERT INTO Admin VALUES('David','szokecigany');
INSERT INTO Admin VALUES('Marci', 'macilaci');
INSERT INTO Admin VALUES('Gergo', 'gitgut');

--
commit;
