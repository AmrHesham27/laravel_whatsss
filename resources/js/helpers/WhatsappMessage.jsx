const WhatsappMessage = (
    cart,
    whatsapp,
    name,
    placeIndex,
    deliveryMethod,
    exactAddress,
    notes,
    places
) => {
    const Enter = `%0a`;
    const Space = `%20`;
    let items = "";
    Object.values(cart["items"]).forEach((item) => {
        items += `${item["name"]}${Space}*${Space}${item["qty"]}${Enter}`;
    });
    const placeName =
        placeIndex && deliveryMethod == "delivery"
            ? places[placeIndex]["name"]
            : "";
    const exactAdressWhatsapp =
        exactAddress && deliveryMethod == "delivery"
            ? `${Enter}العنوان${Space}بالتفصيل:${Enter}${exactAddress}`
            : "";
    const notesWhatsapp = notes
        ? `${Enter}📝${Space}ملاحظات:${Enter}${notes}`
        : "";
    const methodsObject = {
        dinIn: "صالة",
        delivery: `توصيل`,
        pickUp: `استلام${Space}من${Space}المكان`,
    };
    const deliveryMethodWhatsapp = methodsObject[deliveryMethod];

    const href = `https://wa.me/${whatsapp}/?text=${`✅${Space}*طلب${Space}جديد*${Enter}${Enter}الإسم:${Enter}${name}${Enter}${Enter}📜${Space}الطلبات:${Enter}${items}${Enter}طريقة${Space}التوصيل:${Enter}${deliveryMethodWhatsapp}${Enter}${placeName}${Enter}${exactAdressWhatsapp}${Enter}${notesWhatsapp}`}`;

    return href;
};

export default WhatsappMessage;
