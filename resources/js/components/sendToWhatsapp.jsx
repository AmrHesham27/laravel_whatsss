import React, { useState } from "react";
import { useSelector } from "react-redux";

function sendToWhatsapp({
    whatsapp,
    color_1,
    color_2,
    dinIn,
    pickUp,
    deliveryPlaces,
    places,
    currency,
}) {
    const [deliveryMethod, setDeliveryMethod] = useState(false);
    const [placeIndex, setPlaceIndex] = useState();
    const [name, setName] = useState();
    
    const cart = useSelector((state) => state.cart);

    const [total, setTotal] = useState(cart.total);

    const message = `
        #####\n
        New Order\n
        #####\n
        Name: ${name}\n
        #####\n
        Deliver Method\n
        ${deliveryMethod}\n
        #####\n
        Total\n
        ${total}\n
        ######\n
    `

    return (
        <div
            className="modal fade"
            id="send-to-whatsapp"
            tabIndex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div className="modal-dialog" role="document">
                <div className="modal-content">
                    <div className="modal-header d-flex justify-content-between w-100">
                        <button
                            type="button"
                            className="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            style={{ padding: "0", margin: "0" }}
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div
                            className="modal-cart-header"
                            style={{ color: color_1 }}
                        >
                            أدخل بياناتك
                        </div>
                    </div>
                    <div className="modal-body text-right">
                        <form>
                            <div className="form-group">
                                    <label htmlFor="exampleInputEmail1">
                                        الاسم
                                    </label>
                                    <input
                                        type="text"
                                        className="form-control text-right"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        placeholder="ادخل اسمك"
                                        onChange={(e) => setName(e.target.value)}
                                    />
                                </div>
                            <div className="form-group mt-4">
                                <label htmlFor="exampleInputPassword1">
                                    اختر طريقة الاستلام
                                </label>
                                <select
                                    class="form-control form-select"
                                    aria-label="Default select example"
                                    name="category_id"
                                    onChange={(e) =>
                                        setDeliveryMethod(e.target.value)
                                    }
                                >
                                    <option
                                        className="d-flex justify-content-end"
                                        selected
                                        value=""
                                    >
                                        طريقة الاستلام
                                    </option>
                                    {dinIn ? (
                                        <option
                                            className="d-flex justify-content-end"
                                            value="dinIn"
                                        >
                                            حجز طاولة
                                        </option>
                                    ) : undefined}
                                    {pickUp ? (
                                        <option
                                            className="d-flex justify-content-end"
                                            value="pickUp"
                                        >
                                            استلام من المكان
                                        </option>
                                    ) : undefined}
                                    {deliveryPlaces ? (
                                        <option
                                            className="d-flex justify-content-end"
                                            value="deliveryPlaces"
                                        >
                                            توصيل
                                        </option>
                                    ) : undefined}
                                </select>

                                {deliveryPlaces &&
                                deliveryMethod == "deliveryPlaces" ? (
                                    <>
                                        <label htmlFor="exampleInputPassword1">
                                            اختر مكان التوصيل
                                        </label>
                                        <select
                                            class="form-control form-select"
                                            aria-label="Default select example"
                                            onChange={(e) =>
                                                {
                                                    setPlaceIndex(e.target.value);
                                                    setTotal(cart.total + [places][e.target.value]['price'])
                                                }
                                            }
                                        >
                                            <option value="">
                                                مكان التوصيل
                                            </option>
                                            {places.map((place, index) => {
                                                return (
                                                    <option
                                                        key={index}
                                                        value={index}
                                                    >
                                                        {place["name"]} -{" "}
                                                        {place["price"]}
                                                    </option>
                                                );
                                            })}
                                        </select>
                                    </>
                                ) : undefined}
                            </div>

                            <div className="my-3">
                                <span>السعر</span>
                                <div className="d-flex flex-row-reverse">
                                    <span className="mx-1">{currency}</span>
                                    <span>{cart.total}</span>
                                </div>
                            </div>
                            {deliveryPlaces &&
                            deliveryMethod == "deliveryPlaces" &&
                            placeIndex ? (
                                <>
                                    <div className="my-3">
                                        <span>رسوم التوصيل</span>
                                        <div className="d-flex flex-row-reverse">
                                            <span className="mx-1">
                                                {currency}
                                            </span>
                                            <span>
                                                {places[placeIndex]["price"]}
                                            </span>
                                        </div>
                                    </div>
                                    <div className="fw-bold my-3">
                                        <span>الاجمالي</span>
                                        <div className="d-flex flex-row-reverse">
                                            <span className="mx-1">
                                                {currency}
                                            </span>
                                            <span>
                                                {places[placeIndex]["price"] +
                                                    cart.total}
                                            </span>
                                        </div>
                                    </div>
                                </>
                            ) : undefined}

                            <div className="d-flex justify-content-center">
                                <a
                                    className="btn btn-success px-3 my-2"
                                    href={`https://wa.me/${whatsapp}/?text=${message}`}
                                    style={{ backgroundColor: color_2 }}
                                >
                                    اطلب
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default sendToWhatsapp;
