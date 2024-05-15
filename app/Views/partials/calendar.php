<?= $this->extend('layouts/dashboard_bo')?>
<?= $this->section('content')?>
<?= $this->include('partials/page_title')?>

<!-- Seção do calendário -->
<div id="calendar"></div>

<!-- Inclui os produtos no calendário -->
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: <?= $events ?>
        });
    });
</script>

<?= $this->endSection() ?>
