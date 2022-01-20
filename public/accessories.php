<h1>This is the accessories page.</h1>
<script>
    $(()=>{
        $.ajax({
            type: "POST",
            url: "/ajax.php",
            data: {
                search: '',
                displaytype: 1,
                type: 1
            },
            success: function(html) {
                $("#container tbody").html(html).show();
            }
        });
    });
</script>
<link rel="stylesheet" href="<?=base()?>css/table.css">
<section id="container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Health</th>
                <th>Strength</th>
                <th>Constitution</th>
                <th>Intelligence</th>
                <th>Charisma</th>
                <th>Requirement</th>
            </tr>
        </thead>
        <tbody>
            <!-- Search Results -->
        </tbody>
    </table>
</section>