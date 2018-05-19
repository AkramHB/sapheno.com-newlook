<?php

/**
 * Class FMViewFromeditcountryinpopup_fmc
 */
class FMViewFromeditcountryinpopup_fmc {
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
    ?>
    <style>
      .country-list {
        padding: 10px 0;
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

      .fm-select-remove {
        background: #4EC0D9;
        width: 78px;
        height: 32px;
        border: 1px solid #4EC0D9;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
      }

      .fm-select-remove.large {
        width: 90px;
      }
    </style>
    <div class="country-list">
      <div class="select-remove">
        <button class="fm-select-remove large" onclick="select_all(); return false;">
          Select all
          <span></span>
        </button>
        <button class="fm-select-remove large" onclick="remove_all(); return false;">
          Remove all
          <span></span>
        </button>
      </div>
      <div class="save-cancel">
        <button class="fm-select-remove" onclick="save_list(); return false;">
          Save
          <span></span>
        </button>
      </div>
      <ul id="countries_list" style="list-style: none; padding: 0px;"></ul>
    </div>
    <script>
      selec_coutries = [];
      countries = '<?php echo addslashes(json_encode(WDW_FMC_Library::get_countries())); ?>';
      countries = JSON.parse(countries);
      select_ = window.parent.document.getElementById('<?php echo $field_id ?>_elementform_id_temp');
      n = select_.childNodes.length;
      for (i = 0; i < n; i++) {
        selec_coutries.push(select_.childNodes[i].value);
        var ch = document.createElement('input');
        ch.setAttribute("type", "checkbox");
        ch.setAttribute("checked", "checked");
        ch.value = select_.childNodes[i].value;
        ch.id = i + "ch";
        var p = document.createElement('span');
        p.style.cssText = "color:#000000; font-size: 13px; cursor:move";
        p.innerHTML = select_.childNodes[i].value;
        var li = document.createElement('li');
        li.style.cssText = "margin:3px; vertical-align:middle";
        li.id = i;
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
    <?php

    die();
  }
}
