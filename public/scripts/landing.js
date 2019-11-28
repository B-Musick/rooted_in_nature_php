
// /***************************** D3 LANDING ***********************************/ 
// let svg = d3.select('#landing-svg');
// let svgWidth = svg.attr('width');
// let svgHeight = parseInt(svg.attr('height'));
// console.log('hi')
// // Rectangles design
// let rectCount = 20; // Amount of rectangles used
// let rectHeight = svgHeight/rectCount; // Rectangle heights
// let rectWidths = ['10vw','18vw','30vw','60vw','50vw','70vw','90vw','65vw','55vw','30vw','15vw','5vw','2vw','4vw','7vw','20vw','40vw','20vw','10vw','15vw']
// for(let i = 0;i<rectCount;i++){
//     svg.append('rect')
//         .attr('x','0')
//         .attr('y',i*rectHeight+300+"")
//         .attr('width',rectWidths[i])
//         .attr('height',rectHeight+'')
//         .attr('fill', '');
// }