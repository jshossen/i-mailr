<menu class="menu">
    <li class="menu-item">
        <button type="button" class="menu-btn" onclick="show_hide_control();">
            <i class="fa fa-eye-slash"></i>
            <span class="menu-text show_hide_control" id="show_hide_control">Hide control</span>
        </button>
    </li>
    <li class="menu-item">
        <button type="button" class="menu-btn" onclick="undo_json_change();">
            <i class="fa fa-undo"></i>
            <span class="menu-text">Undo</span>
        </button>
    </li>
    <li class="menu-item">
        <button type="button" class="menu-btn" onclick="redo_json_change();">
            <i class="fa fa-repeat"></i>
            <span class="menu-text">Redo</span>
        </button>
    </li>

    <li class="menu-separator"></li>
    <li class="menu-item">
        <button type="button" class="menu-btn" onclick="javascript: $('#pop_up_settings').modal('show'); get_all_bootstrap_modal(); return false;" data-toggle="modal" data-target="#pop_up_settings">
            <i class="fa fa-external-link"></i>
            <span class="menu-text">Show pop-up</span>
        </button>
    </li>
    <li class="menu-item submenu">
        <button type="button" class="menu-btn">
            <i class="fa fa-cog"></i>
            <span class="menu-text">Settings</span>
        </button>
        <menu class="menu">
            <li class="menu-item">
                <button type="button" class="menu-btn" onclick="Javascript: $('#current_editable_element_id').val('div_editorpreview');show_my_panel_for_settings('div_editorpreview');">
                    <i class="fa fa-paint-brush"></i>
                    <span class="menu-text">Body settings</span>
                </button>
            </li>
            <li class="menu-item">
                <button type="button" class="menu-btn" data-toggle="modal" data-target="#customScriptModal">
                    <i class="fa fa-code"></i>
                    <span class="menu-text">Custom script</span>
                </button>
            </li>
            <li class="menu-item">
                <button type="button" class="menu-btn" data-toggle="modal" data-target="#customCssModal">
                    <i class="fa fa-css3"></i>
                    <span class="menu-text">Custom css</span>
                </button>
            </li>
            <li class="menu-item">
                <button type="button" class="menu-btn" data-toggle="modal" data-target="#seo_settings">
                    <i class="fa fa-search-plus"></i>
                    <span class="menu-text">SEO settings</span>
                </button>
            </li>
        </menu>
    </li>
    <li class="menu-separator"></li>
    <li class="menu-item">
        <button type="button" class="menu-btn" onclick="save_my_settings();">
            <i class="fa fa-download"></i>
            <span class="menu-text">Save</span>
        </button>
    </li>
    <li class="menu-item">
        <a target="_blank" href="<?php echo BASE. "/preview/?page=" . $page_id . '/' .get_page_meta($page_id,'page_handle'); ?>">
            <button type="button" class="menu-btn">
                <i class="fa fa-desktop"></i>
                <span class="menu-text">Preview</span>
            </button>
        </a>
    </li>
    <li class="menu-item">
        <a href="<?php echo BASE ?>/dashboard" onclick="save_my_settings();">
            <button type="button" class="menu-btn">
                <i class="fa fa-sign-out"></i>
                <span class="menu-text">Exit</span>
            </button>
        </a>
    </li>
</menu>

<script type="text/javascript">
var menu = document.querySelector('.menu');

function showMenu(x, y){
    menu.style.left = x + 'px';
    menu.style.top = y + 'px';
    menu.classList.add('show-menu');
}

function hideMenu(){
    menu.classList.remove('show-menu');
}

function onContextMenu(e){
    e.preventDefault();
    showMenu(e.pageX, e.pageY);
    document.addEventListener('mousedown', onMouseDown, false);
}

function onMouseDown(e){
    $(e.target).click();
    hideMenu();
    document.removeEventListener('mousedown', onMouseDown);
}

//document.addEventListener('contextmenu', onContextMenu, false);
</script>