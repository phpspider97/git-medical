
$(document).ready(function () {
    $(".btn-convert").on("click", function (e) {
        e.preventDefault();

        const button = $(this);
        button.prop("disabled", true);

        generateA4PDF()
            .catch(function (error) {
                console.error("PDF generation error:", error);
                alert("Unable to generate PDF. Please try again.");
            })
            .finally(function () {
                button.prop("disabled", false);
            });
    });
});

async function generateA4PDF() {
    const element = document.querySelector("#html-template");

    if (!element) {
        throw new Error("#html-template element not found");
    }

    if (typeof html2canvas === "undefined") {
        throw new Error("html2canvas library is not loaded");
    }

    if (typeof jsPDF === "undefined") {
        throw new Error("jsPDF library is not loaded");
    }

    // Wait for fonts before capturing HTML
    if (document.fonts && document.fonts.ready) {
        await document.fonts.ready;
    }

    // Capture report as a high-quality canvas
    const canvas = await html2canvas(element, {
        scale: 2,
        useCORS: true,
        allowTaint: false,
        backgroundColor: "#ffffff",
        logging: false,
        windowWidth: element.scrollWidth,
        windowHeight: element.scrollHeight,
        scrollX: 0,
        scrollY: 0
    });

    // Create A4 PDF in portrait mode
    const pdf = new jsPDF("p", "mm", "a4");

    const pageWidth = 210;
    const pageHeight = 297;

    const margin = 8;

    const contentWidth = pageWidth - (margin * 2);
    const contentHeight = pageHeight - (margin * 2);

    // Scale canvas proportionally to A4 width
    const scaleRatio = contentWidth / canvas.width;

    // Height of the complete report in PDF millimetres
    const totalPdfHeight = canvas.height * scaleRatio;

    // Height of one PDF page in original canvas pixels
    const pageCanvasHeight = Math.floor(
        contentHeight / scaleRatio
    );

    const totalPages = Math.ceil(
        canvas.height / pageCanvasHeight
    );

    for (let page = 0; page < totalPages; page++) {

        if (page > 0) {
            pdf.addPage("a4", "portrait");
        }

        const sourceY = page * pageCanvasHeight;

        const currentHeight = Math.min(
            pageCanvasHeight,
            canvas.height - sourceY
        );

        // Create a separate canvas for each PDF page
        const pageCanvas = document.createElement("canvas");

        pageCanvas.width = canvas.width;
        pageCanvas.height = currentHeight;

        const context = pageCanvas.getContext("2d");

        context.fillStyle = "#ffffff";
        context.fillRect(
            0,
            0,
            pageCanvas.width,
            pageCanvas.height
        );

        context.drawImage(
            canvas,
            0,
            sourceY,
            canvas.width,
            currentHeight,
            0,
            0,
            canvas.width,
            currentHeight
        );

        const imageData = pageCanvas.toDataURL("image/jpeg", 0.95);

        const imageHeight = currentHeight * scaleRatio;

        pdf.addImage(
            imageData,
            "JPEG",
            margin,
            margin,
            contentWidth,
            imageHeight,
            undefined,
            "FAST"
        );
    }

    // Save PDF
    pdf.save("lab-report.pdf");
}
