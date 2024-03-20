if ($("#PensiunChart").length) {
    let bup = $("#PensiunChart").attr('data-bup'),
    jadu = $("#PensiunChart").attr('data-jadu'),
    aps = $("#PensiunChart").attr('data-aps'),
    udzur = $("#PensiunChart").attr('data-udzur'),
    mpp = $("#PensiunChart").attr('data-mpp');

    new ApexCharts(document.querySelector("#PensiunChart"), {
        series: [bup, jadu, aps, udzur, mpp],
        chart: { height: 320, type: "radialBar" },
        colors: ["#28a745", "#ffc107", "#e5e5e5","#ef233c","#4361ee"],
        stroke: { lineCap: "round" },
        plotOptions: {
            radialBar: {
                dataLabels: { show: !0 },
            },
        },
        labels: ['BUP', 'JANDA/DUDA', 'APS', 'UDZUR','MPP'],
    }).render();
}