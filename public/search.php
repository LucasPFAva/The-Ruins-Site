<form id="filtersearchbar" role="search">
    <input type="search" id="filtersearch" class="search-data" placeholder="Search..." autocomplete="off" required>
    <button type="submit" class="fas fa-search"></button>
</form>
<h1>Filter</h1>
<select name="type" id="type">
    <option value="0">Characters</option>
    <option value="1">Accessories</option>
</select>
<script src="<?=base()?>js/search.js"></script>
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