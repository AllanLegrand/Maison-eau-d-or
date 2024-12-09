function changeTab(tabIndex) {
	var tabs = document.querySelectorAll('.tab');
	var contents = document.querySelectorAll('.tab-content');
	
	tabs.forEach((tab, index) => {
		if (index === tabIndex) {
			tab.classList.add('active');
			contents[index].classList.add('active');
		} else {
			tab.classList.remove('active');
			contents[index].classList.remove('active');
		}
	});
}

document.querySelectorAll('.tabs a').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();

        document.querySelectorAll('.tabs a').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        this.classList.add('active');

        const tabContent = document.getElementById(this.getAttribute('data-tab'));
        tabContent.classList.add('active');
    });
});