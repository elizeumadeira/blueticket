<div class=" tipo_ingresso_row">
    {% if not disabled %}
    <input type="button" class="btn btn-danger" value="Excluir" onclick="excluir_ingresso($(this).parent());">
    {% endif %}
    <input type="button" class="btn btn-default" value="Ocultar/Mostrar" onclick="esconder_campos_ingresso($(this).parent());">

    <label class="label_descricao"></label>
    <div class="form-campos">
        <div class="form-group">
            <label>Descrição</label>
            <!-- <textarea class="form-control" name="ingressodescricao"></textarea> -->
            <input type="text" class="form-control" name="ingressodescricao[]" value="{% if descricao %}{{ descricao }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %} />
        </div>

        <div class="form-row">

            <div class="form-group col-md-5">
                <label>Lote </label>
                <input type="text" class="form-control" name="ingressolote[]" value="{% if lote %}{{ lote }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %} required />
            </div>


            <div class="form-group  col-md-4">
                <label>Valor </label>
                <input type="text" class="form-control" name="ingressovalor[]" value="{% if valor %}{{ valor }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %} required />
            </div>
            <div class="form-group  col-md-3">
                <label>Qtd. Max </label>
                <input type="text" class="form-control" name="ingressoqtd_max[]" value="{% if qtd_max %}{{ qtd_max }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %} required />
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Início </label>
                <input type="date" class="form-control" name="ingressoinicio[]" value="{% if dia_inicio %}{{ dia_inicio }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %}  required />
            </div>
            <div class="form-group col-md-6">
                <label>Fim </label>
                <input type="date" class="form-control" name="ingressofim[]" value="{% if dia_fim %}{{ dia_fim }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %} required />
            </div>
        </div>

        <div class="form-group">
            <label>Observação </label>
            <input type="text" class="form-control" name="ingressoobservacao[]" value="{% if observacao %}{{ observacao }}{% endif %}"  {% if disabled %} disabled="disabled" {%endif %} required />
        </div>
    </div>
</div>