<?php

/**
 * Class FMViewFromeditcountryinpopup
 */
class FMViewFromeditcountryinpopup {
  /**
   * Display.
   *
   * @param array $params
   */
  public function display( $params ) {
    $field_id = $params['field_id'];
    wp_print_scripts('jquery');
    wp_print_scripts('jquery-ui-core');
    wp_print_scripts('jquery-ui-widget');
    wp_print_scripts('jquery-ui-mouse');
    wp_print_scripts('jquery-ui-slider');
    wp_print_scripts('jquery-ui-sortable');
    wp_print_styles('wp-admin');
    wp_print_styles('buttons');
    ?>
    <style>
      .handle {
        border: none;
        color: #aaaaaa;
        cursor: move;
        vertical-align: middle;
      }
      input[type="checkbox"] {
        margin: 5px;
      }
      .country-list {
        padding: 10px;
      }
      .country-list ul {
        font-family: Segoe UI !important;
        font-size: 13px;
      }
      .country-list > div {
        display: inline-block;
      }
      .save-cancel {
        float: right;
      }
    </style>
    <div class="country-list wp-core-ui">
      <div class="select-remove">
        <button class="button" onclick="select_all(); return false;">
          <?php _e('Select all', WDFM()->prefix); ?>
        </button>
        <button class="button" onclick="remove_all(); return false;">
          <?php _e('Remove all', WDFM()->prefix); ?>
        </button>
      </div>
      <div class="save-cancel">
        <button class="button button-primary" onclick="save_list(); return false;">
          <?php _e('Save', WDFM()->prefix); ?>
        </button>
      </div>
      <ul id="countries_list" style="list-style: none; padding: 0px;"></ul>
      <script>
        selec_coutries = [];
        countries = '<?php echo addslashes(json_encode(WDW_FM_Library::get_countries())); ?>';
        countries = JSON.parse(countries);
        select_ = window.parent.document.getElementById('<?php echo $field_id ?>_elementform_id_temp');
        n = select_.childNodes.length;
        for (i = 0; i < n; i++) {
          selec_coutries.push(select_.childNodes[i].value);
          var drag = document.createElement('div');
          drag.setAttribute("class", "wd-drag handle dashicons dashicons-move");
          var ch = document.createElement('input');
          ch.setAttribute("type", "checkbox");
          ch.setAttribute("checked", "checked");
          ch.value = select_.childNodes[i].value;
          ch.id = i + "ch";
          var p = document.createElement('span');
          p.style.cssText = "color:#000000; font-size: 13px; cursor:move; vertical-align: middle;";
          p.innerHTML = select_.childNodes[i].value;
          var li = document.createElement('li');
          li.style.cssText = "margin:3px; vertical-align:middle";
          li.id = i;
          li.appendChild(drag);
          li.appendChild(ch);
          li.appendChild(p);
          document.getElementById('countries_list').appendChild(li);
        }
        cur = i;
        for (var cur_country in countries) {
          isin = isValueInArray(selec_coutries, cur_country);
          if (!isin) {
            var ch = document.createElement('input');
            ch.setAttribute("type", "checkbox");
            ch.value = cur_country;
            ch.id = cur + "ch";
            var p = document.createElement('span');
            p.style.cssText = "color:#000000; font-size: 13px; cursor:move";
            p.innerHTML = cur_country;
            var li = document.createElement('li');
            li.style.cssText = "margin:3px; vertical-align:middle";
            li.id = cur;
            li.appendChild(ch);
            li.appendChild(p);
            document.getElementById('countries_list').appendChild(li);
            cur++;
          }
        }
        jQuery(function () {
          jQuery("#countries_list").sortable();
          jQuery("#countries_list").disableSelection();
        });
        function isValueInArray(arr, val) {
          inArray = false;
          for (x = 0; x < arr.length; x++) {
            if (val == arr[x]) {
              inArray = true;
            }
          }
          return inArray;
        }
        function save_list() {
          select_.innerHTML = ""
          ul = document.getElementById('countries_list');
          n = ul.childNodes.length;
          for (i = 0; i < n; i++) {
            if (ul.childNodes[i].tagName == "LI") {
              id = ul.childNodes[i].id;
              if (document.getElementById(id + 'ch').checked) {
                var option_ = document.createElement('option');
                option_.setAttribute("value", document.getElementById(id + 'ch').value);
                option_.innerHTML = document.getElementById(id + 'ch').value;
                select_.appendChild(option_);
              }
            }
          }
          window.parent.tb_remove();
        }
        function select_all() {
          for (i = 0; i < 194; i++) {
            document.getElementById(i + 'ch').checked = true;
          }
        }
        function remove_all() {
          for (i = 0; i < 194; i++) {
            document.getElementById(i + 'ch').checked = false;
          }
        }
      </script>
    </div>
    <?php

    die();
  }
}
