CREATE OR REPLACE VIEW vertelegrama AS 
 SELECT 
 vistadocumento.hdocumento as id,
 vistadocumento.numero as numero, 
 vistadocumento.fecha as fecha,
 vistadocumento.paciente as paciente,
 vistadocumento.hpaciente as idpaciente,
 establecimiento.nombre AS establecimiento,
 vistadocumento.husuario as husuario,
 registrados.cedula as cedulau,
 registrados.nombre as nombreu,
 vistadocumento.diagnostico as diagnostico, 
 vistadocumento.hexamen as hexamen,
 examen.hecg as hecg
 FROM
 vistadocumento,
 establecimiento,
 registrados,
 examen
 WHERE
 vistadocumento.husuario=registrados.id AND
 vistadocumento.horigen=establecimiento.id AND
 vistadocumento.hexamen = examen.id
order by  
  vistadocumento.hdocumento;
ALTER TABLE vertelegrama
  OWNER TO postgres;
GRANT ALL ON TABLE vertelegrama TO postgres;
GRANT ALL ON TABLE vertelegrama TO cardiologico;  