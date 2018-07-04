function loadEboard(idname){
	var customBoard2 = new DrawingBoard.Board(idname, {
		controls: [
			'Color',
			{ Size: { type: 'dropdown' } },
			{ DrawingMode: { filler: false } },
			'Navigation',
			'Download'
		],
		size: 2,
		webStorage: false,
		enlargeYourContainer: true,
		droppable: true, //try dropping an image on the canvas!
		stretchImg: true //the dropped image can be automatically ugly resized to to take the canvas size
	});
}