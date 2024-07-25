<script>
    function get_select_items_datatable(){
    var rows_selected = table.column(0).checkboxes.selected();
      let arr = [];
      $.each(rows_selected, function(index, rowId){
           arr.push(rowId);
      });

     return arr;
}
</script>