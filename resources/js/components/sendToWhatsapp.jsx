import React, { useState } from "react";
import { useSelector } from "react-redux";

function sendToWhatsapp({ dinIn, pickUp, delivery, places }) {
    const [deliveryMethod, setDeliveryMethod] = useState(false);
    const [placeIndex, setPlaceIndex] = useState();
    const [name, setName] = useState();
    const whatsapp = localStorage.getItem("whatsapp");

    const cart = useSelector((state) => state.cart);

    // %20 => space ,, line break => %0a

    let items = "";
    Object.values(cart["items"]).forEach((item) => {
        items += `${item["name"]}%20X%20${item["qty"]}%0a`;
    });
    const href = `https://wa.me/${whatsapp}/?text=${`New%20Order%0aName:%20${name}%0aItems:%0a${items}Delivery%20Method%0a${deliveryMethod}%0a${
        placeIndex && deliveryMethod == "delivery"
            ? places[placeIndex]["name"]
            : ""
    }
    `}`;

    const color_1 = localStorage.getItem("color_1");
    const color_2 = localStorage.getItem("color_2");
    const currency = localStorage.getItem("currency");

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
                                    {delivery ? (
                                        <option
                                            className="d-flex justify-content-end"
                                            value="delivery"
                                        >
                                            توصيل
                                        </option>
                                    ) : undefined}
                                </select>

                                {delivery && deliveryMethod == "delivery" ? (
                                    <>
                                        <label htmlFor="exampleInputPassword1" className="mt-4">
                                            اختر مكان التوصيل
                                        </label>
                                        <select
                                            class="form-control form-select"
                                            aria-label="Default select example"
                                            onChange={(e) => {
                                                setPlaceIndex(e.target.value);
                                            }}
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

                            <div className="mt-3">
                                <span>{cart.total}</span>
                                <span className="mx-1">{currency}</span>
                                <span>السعر</span>
                            </div>
                            {delivery &&
                            deliveryMethod == "delivery" &&
                            placeIndex ? (
                                <>
                                    <div>
                                        <span>
                                            {places[placeIndex]["price"]}
                                        </span>
                                        <span className="mx-1">{currency}</span>
                                        <span className="mx-1">
                                            رسوم التوصيل
                                        </span>
                                    </div>
                                    <div className="font-weight-bold">
                                        <span>
                                            {places[placeIndex]["price"] +
                                                cart.total}
                                        </span>
                                        <span className="mx-1">{currency}</span>
                                        <span className="mx-1">الاجمالي</span>
                                    </div>
                                </>
                            ) : undefined}

                            <div className="d-flex justify-content-center">
                                <a
                                    className="btn btn-success px-3 my-2"
                                    href={href}
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
