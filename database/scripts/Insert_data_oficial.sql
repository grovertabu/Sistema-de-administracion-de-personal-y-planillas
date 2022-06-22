INSERT INTO estructura_organizacionals(id,nombre,version,estado) VALUES
(1,'ELAPAS 2022',1,'ACTIVO');


INSERT INTO escala_salarials(id,nivel,descripcion,casos,salario_mensual,estructura_organizacional_id,estado) VALUES
(1,1,'GERENCIA GENERAL',1,17827,1,'ACTIVO'),
(2,2,'GERENCIAS DE AREA',3,14134,1,'ACTIVO'),
(3,3,'JEFES DE AREA',14,11415,1,'ACTIVO');

INSERT INTO unidad_organizacionals(id,seccion,estructura_organizacional_id,estado) VALUES
(1,'GERENCIA GENERAL',1,'ACTIVO'),
(2,'GERENCIAS DE AREA',1,'ACTIVO'),
(3,'JEFES DE AREA',1,'ACTIVO');

INSERT INTO cargos(id,nombre,estructura_organizacional_id,estado) VALUES
(1,'GERENTE GENERAL',1,'ACTIVO'),
(2,'GERENTE ADMINISTRATIVO Y FINANCIERO',1,'ACTIVO'),
(3,'JEFE ADMINISTRATIVO Y DE PERSONAL ',1,'ACTIVO');

INSERT INTO tipo_contratos(id,nombre,estado) VALUES
(1,'ITEM','ACTIVO'),
(2,'CONSULTOR','ACTIVO'),
(3,'EVENTUAL','ACTIVO'),
(4,'PAE','ACTIVO');

INSERT INTO nomina_cargos(id,item,tipo_contrato_id,unidad_organizacional_id,escala_salarial_id,cargo_id,estado) VALUES
(1,1,1,1,1,1,'OCUPADO'),
(2,2,1,2,2,2,'OCUPADO'),
(3,3,1,2,2,3,'LIBRE');


INSERT INTO asignacion_cargos(id,codigo,fecha_ingreso,fecha_conclusion,observacion,aporte_afp,sindicato,socio_fe,trabajador_id,nomina_cargo_id,estado) VALUES
(1,1,'2018-12-20',null,'','SI','NO','NO',1,1,'HABILITADO'),
(2,1,'1999-01-06',null,'','NO','NO','SI',2,2,'HABILITADO');


