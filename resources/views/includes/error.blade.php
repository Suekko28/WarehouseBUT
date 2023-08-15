@error($data)
<script>
    $('input[name={{ $data }}],textarea[name={{ $data }}],select[name={{ $data }}]').addClass('is-invalid');
</script>
<span class="invalid-feedback d-block">
    {{ $message }}
</span>
@enderror
