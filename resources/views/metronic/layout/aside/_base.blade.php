<!--begin::Aside-->
<div id="kt_aside"
	class="aside overflow-visible pb-5 pt-5 pt-lg-0 "
	data-kt-drawer="true"
	data-kt-drawer-name="aside"
	data-kt-drawer-activate="{default: true, lg: false}"
	data-kt-drawer-overlay="true"
	data-kt-drawer-width="{default:'80px', '300px': '100px'}"
	data-kt-drawer-direction="start"
	data-kt-drawer-toggle="#kt_aside_mobile_toggle"
	>
    <div class="aside-logo  py-8" id="kt_aside_logo">
        <a href="?page=index" class="d-flex align-items-center">
            <img alt="Logo" src="{{asset('img/logo.png')}}" class="h-85px logo"/>
        </a>
    </div>
	<div class="aside-menu flex-column-fluid" id="kt_aside_menu">
        @include("metronic/layout/aside/_menu")
    </div>
    <div class="aside-footer flex-column-auto" id="kt_aside_footer">
		<div class="d-flex justify-content-center">
            <button type="button" class="btn btm-sm btn-icon btn-active-color-primary"
                data-kt-menu-trigger="click" data-kt-menu-overflow="true"
                data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
                data-bs-dismiss="click" title="Soporte">
                <span class="svg-icon svg-icon-muted svg-icon-2hx">
                    <i class="ki-outline ki-message-text-2 fs-2qx"></i>
                </span>
            </button>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px"
                data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Ayuda</div>
                </div>
                <div class="separator mb-3 opacity-75"></div>
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Nuevo Ticket</a>
                </div>
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">Reportar</a>
                </div>
            </div>
        </div>
	</div>
</div>
