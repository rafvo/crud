var DATATABLES = {
    DataTableClass: function () {
        $('.table').DataTable({
            "order": [],
            language: {
                processing: "Carregando...",
                search: "Buscar",
                lengthMenu: "Exibindo _MENU_ registros",
                info: "Exibindo de _START_ a _END_ registro(s)",
                infoEmpty: "Nenhum registro encontrado",
                infoFiltered: "(Filtrado de _MAX_ registros no total)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum registro encontrado na busca",
                emptyTable: "Nenhum registro encontrado",
                paginate: {
                    first: "Primeiro",
                    previous: "Anterior",
                    next: "Próximo",
                    last: "Último"
                },
                retrieve: true,
                aria: {
                    sortAscending: ": A coluna foi ordenada por registros crescentes",
                    sortDescending: ": A coluna foi ordenada por registros decrescentes"
                }
            }
        });
    },
    DataTableId: function (tableId) {
        $('#' + tableId).DataTable({
            "order": [],
            language: {
                processing: "Carregando...",
                search: "<i class='fas fa-search pr-2'></i>Buscar",
                lengthMenu: "Exibindo _MENU_ registros",
                info: "Exibindo de _START_ a _END_ registro(s)",
                infoEmpty: "Nenhum registro encontrado",
                infoFiltered: "(Filtrado de _MAX_ registros no total)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum registro encontrado na busca",
                emptyTable: "Nenhum registro encontrado",
                paginate: {
                    first: "Primeiro",
                    previous: "Anterior",
                    next: "Próximo",
                    last: "Último"
                },
                aria: {
                    sortAscending: ": A coluna foi ordenada por registros crescentes",
                    sortDescending: ": A coluna foi ordenada por registros decrescentes"
                }
            },
        });
    },
    // DataTableIdFixedHeader: function (tableId) {
    //     $('#' + tableId).DataTable({    
    //         "order": [],
    //         language: {
    //             processing: "Carregando...",
    //             search: "<i class='fas fa-search pr-2'></i>Buscar",
    //             lengthMenu: "Exibindo _MENU_ registros",
    //             info: "Exibindo de _START_ a _END_ registro(s)",
    //             infoEmpty: "Nenhum registro encontrado",
    //             infoFiltered: "(Filtrado de _MAX_ registros no total)",
    //             infoPostFix: "",
    //             loadingRecords: "Carregando...",
    //             zeroRecords: "Nenhum registro encontrado na busca",
    //             emptyTable: "Nenhum registro encontrado",
    //             paginate: {
    //                 first: "Primeiro",
    //                 previous: "Anterior",
    //                 next: "Próximo",
    //                 last: "Último"
    //             },
    //             aria: {
    //                 sortAscending: ": A coluna foi ordenada por registros crescentes",
    //                 sortDescending: ": A coluna foi ordenada por registros decrescentes"
    //             }
    //         },
    //         destroy: true,
    //         fixedHeader : {
    //             header : true,
    //             headerOffset: 45,
    //         },
    //     });

    // },
}
