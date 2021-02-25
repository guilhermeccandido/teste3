-- VIEW utilizada para renderização do relatório "Fiscalização Mensal"
-- public.vw_relatorio_completo source

CREATE OR REPLACE VIEW public.vw_relatorio_completo
AS SELECT row_number() OVER (ORDER BY pas.id, fases.id, pas_fases_movimentacao.data_protocolo)::integer AS id,
    pas.id AS id_lote,
    pas.titulo AS titulo_lote,
    estados.uf,
    pas_trechos.km_inicial,
    pas_trechos.km_final,
    pas_trechos.extensao,
    pas_trechos.subtrecho,
    pas.lote AS nr_lote,
    fases.id AS id_produto,
    fases.titulo AS nm_produto,
    ct.contrato,
    pas_fases.data_ini,
    pas_fases.data_fim,
    pas_fases.data_ini_planejada,
    pas_fases.data_fim_planejada,
    status.titulo AS nm_status,
    pas_fases_movimentacao.data_protocolo,
    pas_fases_movimentacao.descricao,
    usuario.nome AS nome_responsavel
   FROM fases,
    pas,
    pas_fases,
    pas_fases_movimentacao,
    status,
    usuario,
    estados,
    pas_trechos,
    ( SELECT p.id,
            c.contrato
           FROM contratos c
             JOIN pas p ON p.id_contrato = c.id) ct
  WHERE pas_trechos.id_pas = pas.id AND estados.id = pas_trechos.id_estados AND pas_fases.id_fases = fases.id AND pas_fases.id_pas = pas.id AND pas_fases_movimentacao.id_pas_fases = pas_fases.id AND status.id = pas_fases_movimentacao.id_status AND usuario.id_usuario = pas_fases.id_responsavel AND ct.id = pas.id
  ORDER BY pas.id, fases.id, pas_fases_movimentacao.data_protocolo;