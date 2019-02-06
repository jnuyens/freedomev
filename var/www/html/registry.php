<?php
    $registry = explode("\n", `lvs`);

    // This only gets run on development laptops
    if (file_exists('lvs_example.txt'))
        $registry = explode("\n", file_get_contents("lvs_example.txt"));

    array_shift($registry); // throw away the first item since it's a header

//    // Now we're going to sort the registry into categories:
//    foreach ($registry as $row) {
//
//    }

?>
<table class="table table-striped">
    <?php
    foreach ($registry as $row) {
        $data = str_getcsv($row);
        echo '<tr scope="row">';

        // varname
        $varname = $data[0];
        echo "<td>".$varname."</td>";

        // The value
        $value = $data[1];
        ?>
        <td>
            <input id="<?php echo $varname; ?>" name="<?php echo $varname; ?>" type="text" value="<?php echo $value; ?>" class="form-control registry-input" />
            <i class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
            <span class="sr-only">Loading...</span>
        </td>
        <?php
        echo "</tr>";
    }
    ?>
</table>
<script>
// Event handler for the registry inputs
$(".registry-input").on("change", function (ev) {
console.log(ev);

// Do ajax call
$.ajax({
url: 'controller.php',
data: {
command: 'update_lvs',
key: ev.currentTarget.id,
value: $(ev.currentTarget).val()
}
}).done(function () {
}).fail(function () {
}).always(function () {

// When the call returns: hide the spinner again
$("#" + ev.currentTarget.id + "~ i").addClass("d-none");

});
});
</script>