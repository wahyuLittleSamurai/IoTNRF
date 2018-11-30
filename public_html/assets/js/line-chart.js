
/*--------------  overview-chart start ------------*/
if ($('#verview-shart').length) {
    var myConfig = {
        "type": "line",

        "scale-x": { //X-Axis
            "labels": ["0", "10", "20", "30", "40", "50", "60", "70", "80", "90", "100"],
            "label": {
                "font-size": 14,
                "offset-x": 0,
            },
            "item": { //Scale Items (scale values or labels)
                "font-size": 10,
            },
            "guide": { //Guides
                "visible": false,
                "line-style": "solid", //"solid", "dotted", "dashed", "dashdot"
                "alpha": 1
            }
        },
        "plot": { "aspect": "spline" },
        "series": [{
                "values": [20, 25, 30, 35, 45, 40, 40, 35, 25, 17, 40, 50],
                "line-color": "#F0B41A",
                /* "dotted" | "dashed" */
                "line-width": 5 /* in pixels */ ,
                "marker": { /* Marker object */
                    "background-color": "#D79D3B",
                    /* hexadecimal or RGB value */
                    "size": 5,
                    /* in pixels */
                    "border-color": "#D79D3B",
                    /* hexadecimal or RBG value */
                }
            },
            {
                "values": [40, 45, 30, 20, 30, 35, 45, 55, 40, 30, 55, 30],
                "line-color": "#0884D9",
                /* "dotted" | "dashed" */
                "line-width": 5 /* in pixels */ ,
                "marker": { /* Marker object */
                    "background-color": "#067dce",
                    /* hexadecimal or RGB value */
                    "size": 5,
                    /* in pixels */
                    "border-color": "#067dce",
                    /* hexadecimal or RBG value */
                }
            }
        ]
    };

    zingchart.render({
        id: 'verview-shart',
        data: myConfig,
        height: "100%",
        width: "100%"
    });
}

/*--------------  overview-chart END ------------*/
