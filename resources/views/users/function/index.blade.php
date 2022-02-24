<script>
    $(document).ready(function() {
        table = new Tabulator("#consultausers", {
            ajaxURL: "{{ route('users.getusers') }}",
            ajaxURLGenerator:function(url, config, params){
                //url - the url from the ajaxURL property or setData function
                //config - the request config object from the ajaxConfig property
                //params - the params object from the ajaxParams property, this will also include any pagination, filter and sorting properties based on table setup
                //return request url
                return url + "?params=" + encodeURI(JSON.stringify(params)); //encode parameters as a json object
            },
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No se encontraron datos",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    hozAlign: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "Avatar",
                    minWidth: 200,
                    field: "images",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let url = "{{ asset('/dist/images/imgd4u') }}";
                        let imgd4u = cell.getData().photo ? cell.getData().photo : 'preview-1.jpg';
                        let imgF = url.replace('imgd4u', imgd4u);

                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="avatar" id="imgd4u" class="imgd4u rounded-full" src="${imgF}">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "Nombre",
                    minWidth: 100,
                    responsive: 0,
                    field: "name",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Email",
                    minWidth: 120,
                    responsive: 0,
                    field: "email",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                },
                {
                    title: "Estatus",
                    minWidth: 120,
                    responsive: 0,
                    field: "active",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center ${
                            cell.getData().active
                                ? "text-theme-9"
                                : "text-theme-6"
                        }">
                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ${
                            cell.getData().active ? "Activo" : "Inactivo"
                        }
                        </div>`;
                    },
                },
                {
                    title: "Acciones",
                    minWidth: 120,
                    field: "id",
                    headerSort: false,
                    responsive: 0,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a = cash(`<div class="flex lg:justify-center items-center">
                            <a class="show flex items-center mr-3" href="javascript:;">
                                <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                            </a>
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                            </a>
                            <a class="delete flex items-center text-theme-6" href="javascript:;">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                            </a>
                        </div>`);
                        cash(a)
                            .find(".show")
                            .on("click", function () {
                                let url = "{{ route('users.show', 'idr') }}"
                                let idr = cell.getData().id;
                                location.href = url.replace('idr', idr);
                            });

                        cash(a)
                            .find(".edit")
                            .on("click", function () {
                                let url = "{{ route('users.edit', 'idr') }}"
                                let idr = cell.getData().id;
                                location.href = url.replace('idr', idr);
                            });

                        cash(a)
                            .find(".delete")
                            .on("click", function () {
                                let url = "{{ route('users.destroy', 'idr') }}"
                                let idr = cell.getData().id;
                                location.href = url.replace('idr', idr);
                            });

                        return a[0];
                    },
                },
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });
    })

    window.addEventListener("resize", () => {
        table.redraw();
        feather.replace({
            "stroke-width": 1.5,
        });
    });

    // Filter function
    function filterHTMLForm() {
        let field = cash("#tabulator-html-filter-field").val();
        let type = cash("#tabulator-html-filter-type").val();
        let value = cash("#tabulator-html-filter-value").val();
        if (value !== '') {
            table.setFilter(field, type, value);
        } else {
            table.clearFilter();
        }

    }

    // On submit filter form
    cash("#tabulator-html-filter-form")[0].addEventListener(
        "keypress",
        function (event) {
            let keycode = event.keyCode ? event.keyCode : event.which;
            if (keycode == "13") {
                event.preventDefault();
                filterHTMLForm();
            }
        }
    );

    // On click go button
    cash("#tabulator-html-filter-go").on("click", function (event) {
        filterHTMLForm();
    });

    // On reset filter form
    cash("#tabulator-html-filter-reset").on("click", function (event) {
        cash("#tabulator-html-filter-field").val("name");
        cash("#tabulator-html-filter-type").val("like");
        cash("#tabulator-html-filter-value").val("");
        filterHTMLForm();
    });
</script>
