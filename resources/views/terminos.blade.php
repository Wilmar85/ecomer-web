@extends('layouts.app')

@section('content')
<div class="terminos">
    <h1 class="terminos__title">Términos y Condiciones</h1>
    <div class="terminos__card">
        <p>
            Aquí van los términos y condiciones de uso de la plataforma. Puedes personalizarlos según las necesidades de tu negocio.
        </p>
        <ul class="terminos__list">
            <li>El usuario acepta proporcionar información verídica.</li>
            <li>El uso de la plataforma implica la aceptación de estos términos.</li>
            <li>La empresa se reserva el derecho de modificar los términos en cualquier momento.</li>
            <!-- Agrega más puntos según tus necesidades -->
        </ul>
    </div>
<div class="terminos__aceptar" style="margin-top:2rem; text-align:center;">
    <input type="checkbox" id="aceptarTerminos">
    <label for="aceptarTerminos">Acepto los términos y condiciones</label>
    <button id="btnAceptarTerminos" disabled style="margin-left:1rem; padding:0.5rem 1.2rem; border-radius:0.5rem; background:#2563eb; color:#fff; border:none; font-weight:600;">Aceptar</button>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var chk = document.getElementById('aceptarTerminos');
    var btn = document.getElementById('btnAceptarTerminos');
    if (chk && btn) {
        chk.addEventListener('change', function() {
            btn.disabled = !chk.checked;
        });
    }
});
</script>
@endsection
