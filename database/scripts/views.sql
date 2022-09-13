CREATE OR REPLACE VIEW v_asistencia AS
SELECT a.id AS asistencia_id,
       a.mes AS asistencia_mes,
       a.tipo_contrato AS asistencia_tipo_contrato,
       a.gestion AS asistencia_gestion,
       a.dias_asistencia AS asistencia_dias_asistencia,
       a.dias_laborales AS asistencia_dias_laborales,
       ac.id AS asignacion_cargo_id,
       ac.estado as contrato_estado,
       nc.item AS cargo_item,
       cargo.nombre AS cargo_nombre,
       nc.tipo_contrato_id AS tipo_contrato,
       CONCAT(t.ci,' ',t.complemento,' ',t.expedido) AS trabajador_ci,
       CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno) AS trabajador_nombre
FROM asistencias a
INNER JOIN asignacion_cargos ac on a.asignacion_cargo_id = ac.id
INNER JOIN nomina_cargos nc on ac.nomina_cargo_id=nc.id
INNER JOIN cargos as cargo on nc.cargo_id=cargo.id
INNER JOIN trabajadors t on ac.trabajador_id=t.id
