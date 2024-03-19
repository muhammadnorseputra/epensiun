function formatDateSQLToIndo(date) {
	const tanggalAwal = new Date(date);
	const tanggalDiformat = tanggalAwal.toLocaleDateString("id-ID", {
		day: "2-digit",
		month: "2-digit",
		year: "numeric",
	});
	return tanggalDiformat;
}

function formatDateTimeSQLToIndo(date) {
    const datetimeString = date;
    const dateTimeParts = datetimeString.split(' ');
    const dateParts = dateTimeParts[0].split('-');
    const timeParts = dateTimeParts[1].split(':');
    
    const year = dateParts[0];
    const month = dateParts[1];
    const day = dateParts[2];
    
    const hour = timeParts[0];
    const minute = timeParts[1];
    
    const formattedDatetime =  day + '/' + month + '/' + year + ' ' + hour + '.' + minute;
    

    return formattedDatetime;
}
