function hitungPersentase(numerator, denominator) {
	if (denominator === 0) {
		return 0; // Menghindari pembagian dengan nol
	}
	return (numerator / denominator) * 100;
}

if ($("#PensiunChart").length) {
	let bup = $("#PensiunChart").attr("data-bup"),
		jadu = $("#PensiunChart").attr("data-jadu"),
		aps = $("#PensiunChart").attr("data-aps"),
		udzur = $("#PensiunChart").attr("data-udzur"),
		mpp = $("#PensiunChart").attr("data-mpp");

	let total = bup + jadu + aps + udzur + mpp;
	new ApexCharts(document.querySelector("#PensiunChart"), {
		series: [
			bup,
			jadu,
			aps,
			udzur,
			mpp,
		],
		chart: { height: 320, type: "radialBar" },
		colors: ["#28a745", "#ffc107", "#e5e5e5", "#ef233c", "#4361ee"],
		stroke: { lineCap: "round" },
		plotOptions: {
			radialBar: {
				dataLabels: { show: !0 },
			},
		},
		labels: ["BUP", "JANDA/DUDA", "APS", "UDZUR", "MPP"],
	}).render();
}

if ($("#PensiunChartByKesalahan").length) {
	let btl = $("#PensiunChartByKesalahan").attr("data-btl"),
		tms = $("#PensiunChartByKesalahan").attr("data-tms");
	let total = btl + tms;
	var options = {
		series: [hitungPersentase(tms, total), hitungPersentase(btl, total)],
		chart: {
			height: 320,
			type: "pie",
		},
		colors: ["#ef233c", "#ffc107"],
		labels: [`TMS (Tidak Memenuhi Syarat)`, "BTL (Berkas Tidak Lengkap)"],
		responsive: [
			{
				breakpoint: 480,
				options: {
					chart: {
						width: 200,
					},
					legend: {
						position: "bottom",
					},
				},
			},
		],
	};

	var chart = new ApexCharts(
		document.querySelector("#PensiunChartByKesalahan"),
		options
	);
	chart.render();
}



if ($("#PensiunChartUsulanPeriode").length) {
	var options = {
		series: [
			{
				name: "Pensiun Total",
				data: [],
			},
		],
		chart: {
			height: 350,
			type: "bar",
		},
		plotOptions: {
			bar: {
				borderRadius: 10,
				dataLabels: {
					position: "top", // top, center, bottom
				},
			},
		},
		dataLabels: {
			enabled: true,
			formatter: function (val) {
				return val;
			},
			offsetY: -20,
			style: {
				fontSize: "12px",
				colors: ["#304758"],
			},
		},

		xaxis: {
			categories: [
				"Jan",
				"Feb",
				"Mar",
				"Apr",
				"May",
				"Jun",
				"Jul",
				"Aug",
				"Sep",
				"Oct",
				"Nov",
				"Dec",
			],
			position: "top",
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false,
			},
			crosshairs: {
				fill: {
					type: "gradient",
					gradient: {
						colorFrom: "#D8E3F0",
						colorTo: "#BED1E6",
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					},
				},
			},
			tooltip: {
				enabled: true,
			},
		},
		yaxis: {
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false,
			},
			labels: {
				show: false,
				formatter: function (val) {
					return val;
				},
			},
		},
		title: {
			text: null,
			floating: true,
			offsetY: 330,
			align: "center",
			style: {
				color: "#444",
			},
		},
	};
	var chart = new ApexCharts(
		document.querySelector("#PensiunChartUsulanPeriode"),
		options
	);
	chart.render();
	
}

function updateChartPeriode(unorid) {
	$.ajax({
		url: `${_uri}/app/dashboard/chartUsulPensiunByPeriode`,
		method: "post",
		data: {
			unorid: unorid
		},
		success: function (res) {
			chart.updateSeries([{
				data: Object.values(res.row)
			}])
			chart.updateOptions({
				title: {
					text: res.nama_unit_kerja
				} 
			})
		},
	});
}

$(document).ready(function () {
	// getListUnor
	$("#single-select-clear-field").select2({
		width: "100%",
		placeholder: $(this).data("placeholder"),
		allowClear: true,
	});
	updateChartPeriode($("#PensiunChartUsulanPeriode").attr('data-unorid'));
	$('#single-select-clear-field').on('change', function(e) {
        const selectedValue = $(this).val();
		updateChartPeriode(selectedValue);
    });
});