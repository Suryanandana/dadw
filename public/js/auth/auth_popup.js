function openPopup(url, title) {
    const width = 600;
    const height = 700;
    const left = (screen.width - width) / 2;
    const top = (screen.height - height) / 3;

    window.open(url, title, `width=${width},height=${height},top=${top},left=${left},status=1,menubar=0,toolbar=0`);
}