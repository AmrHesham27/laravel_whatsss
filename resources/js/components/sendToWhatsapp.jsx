import React, { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import Modal from "react-bootstrap/Modal";
import { modalsActions } from "../redux/modals";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCheck } from "@fortawesome/free-solid-svg-icons";
import WhatsappMessage from "../helpers/WhatsappMessage";
import ApplyCoupon from "../helpers/ApplyCoupon";

function SendToWhatsapp(props) {
    const color_1 = localStorage.getItem("color_1");
    const color_2 = localStorage.getItem("color_2");
    const currency = localStorage.getItem("currency");
    const whatsapp = localStorage.getItem("whatsapp");
    const delivery = localStorage.getItem("delivery");
    const pickUp = localStorage.getItem("pickUp");
    const dinIn = localStorage.getItem("dinIn");

    const [deliveryMethod, setDeliveryMethod] = useState(false);
    const [placeIndex, setPlaceIndex] = useState();
    const [name, setName] = useState();
    const [notes, setNotes] = useState();
    const [exactAddress, setExactAddress] = useState();
    const [couponCode, setCouponCode] = useState("");
    const [coupon, setCoupon] = useState(null);

    const cart = useSelector((state) => state.cart);

    const href = WhatsappMessage(
        cart,
        whatsapp,
        name,
        placeIndex,
        deliveryMethod,
        exactAddress,
        notes,
        props['places']
    );

    const modals = useSelector((state) => state.modals);
    const dispatch = useDispatch();

    const handleForm = (e) => {
        e.preventDefault();
        window.location.href = href;
    };

    const applyCoupon = () => {
        ApplyCoupon(couponCode, setCoupon, setCouponCode, props['store_id'])
    };

    return (
        <Modal
            {...props}
            size="lg"
            aria-labelledby="contained-modal-title-vcenter"
            centered
            show={modals.sendToWhatsapp}
            onHide={() => dispatch(modalsActions.toggleSendToWhatsapp())}
        >
            <Modal.Header
                closeButton
                className="d-flex flex-row-reverse justify-content-between send-whatsapp-header"
            >
                <Modal.Title
                    id="contained-modal-title-vcenter"
                    style={{
                        color: color_1,
                        display: "flex",
                        flexDirection: "row-reverse",
                        justifyContent: "space-between",
                    }}
                >
                    أدخل بياناتك
                </Modal.Title>
            </Modal.Header>
            <Modal.Body className="tex-right">
                <form style={{ textAlign: "end" }} onSubmit={handleForm}>
                    <div className="form-group">
                        <label htmlFor="exampleInputEmail1">الاسم</label>
                        <input
                            type="text"
                            className="form-control text-right"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            placeholder="ادخل اسمك"
                            onChange={(e) => setName(e.target.value)}
                            style={{ textAlign: "end" }}
                            required
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
                            onChange={(e) => setDeliveryMethod(e.target.value)}
                            style={{ textAlign: "end" }}
                            required
                        >
                            <option
                                className="d-flex justify-content-end"
                                selected
                                value=""
                            >
                                طريقة الاستلام
                            </option>
                            {dinIn == "1" ? (
                                <option
                                    className="d-flex justify-content-end"
                                    value="dinIn"
                                >
                                    حجز طاولة
                                </option>
                            ) : undefined}
                            {pickUp == "1" ? (
                                <option
                                    className="d-flex justify-content-end"
                                    value="pickUp"
                                >
                                    استلام من المكان
                                </option>
                            ) : undefined}
                            {delivery == "1" ? (
                                <option
                                    className="d-flex justify-content-end"
                                    value="delivery"
                                >
                                    توصيل
                                </option>
                            ) : undefined}
                        </select>

                        {delivery == "1" && deliveryMethod == "delivery" ? (
                            <>
                                <label
                                    htmlFor="exampleInputPassword1"
                                    className="mt-4"
                                >
                                    اختر مكان التوصيل
                                </label>
                                <select
                                    class="form-control form-select"
                                    aria-label="Default select example"
                                    onChange={(e) => {
                                        setPlaceIndex(e.target.value);
                                    }}
                                    style={{ textAlign: "end" }}
                                    required
                                >
                                    <option value="">مكان التوصيل</option>
                                    {props["places"].map((place, index) => {
                                        return (
                                            <option key={index} value={index}>
                                                {place["name"]}
                                            </option>
                                        );
                                    })}
                                </select>
                            </>
                        ) : undefined}
                    </div>

                    {delivery == "1" && deliveryMethod == "delivery" ? (
                        <div className="form-group mt-4">
                            <label htmlFor="exampleInputEmail1">
                                العنوان بالتفصيل
                            </label>
                            <input
                                type="text"
                                className="form-control text-right"
                                placeholder="ادخل عنوانك بالتفصيل"
                                onChange={(e) =>
                                    setExactAddress(e.target.value)
                                }
                                style={{ textAlign: "end" }}
                                required
                            />
                        </div>
                    ) : undefined}

                    <div className="input-group mt-4">
                        <label
                            htmlFor="exampleInputEmail1"
                            style={{ width: "100%" }}
                        >
                            ادخل كوبون خصم اذا كنت تمتلك واحدا
                        </label>
                        {coupon ? (
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="basic-addon1"
                                >
                                    <FontAwesomeIcon
                                        icon={faCheck}
                                        size={"1x"}
                                        style={{
                                            color: "#28a745",
                                            margin: "5px",
                                        }}
                                    />
                                </span>
                            </div>
                        ) : undefined}
                        <input
                            type="text"
                            className="form-control text-right"
                            placeholder="ادخل كوبون خصم"
                            onChange={(e) =>
                                setCouponCode(e.target.value.trim())
                            }
                            style={{ textAlign: "end" }}
                        />
                    </div>

                    <div className="form-group mt-4">
                        <label htmlFor="exampleInputEmail1">ملاحظات</label>
                        <textarea
                            className="form-control text-right"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            onChange={(e) => setNotes(e.target.value)}
                            style={{ textAlign: "end" }}
                        ></textarea>
                    </div>

                    <div className="mt-3">
                        <span className="mx-2">السعر</span>
                        <span>
                            {!coupon
                                ? cart.total
                                : coupon["type"] == "flat"
                                ? cart.total - coupon["amount"]
                                : (cart.total * coupon["amount"]) / 100}
                        </span>
                        <span className="mx-1">{currency}</span>
                    </div>
                    {delivery == "1" &&
                    deliveryMethod == "delivery" &&
                    placeIndex ? (
                        <>
                            <div>
                                <span className="mx-2">رسوم التوصيل</span>
                                <span>
                                    {props["places"][placeIndex]["price"]}
                                </span>
                                <span className="mx-1">{currency}</span>
                            </div>
                            <div className="fw-bold">
                                <span className="mx-2">الاجمالي</span>
                                <span>
                                    {coupon
                                        ? props["places"][placeIndex]["price"] +
                                          cart.total -
                                          (coupon["type"] == "flat"
                                              ? coupon["amount"]
                                              : (cart.total *
                                                    coupon["amount"]) /
                                                100)
                                        : props["places"][placeIndex]["price"] +
                                          cart.total}
                                </span>
                                <span className="mx-1">{currency}</span>
                            </div>
                        </>
                    ) : undefined}

                    {couponCode == "" ? (
                        <div className="d-flex justify-content-center mt-4">
                            <button
                                className="btn btn-success px-3 my-3"
                                style={{ backgroundColor: color_2 }}
                                type="submit"
                            >
                                اطلب
                            </button>
                        </div>
                    ) : (
                        <div className="d-flex justify-content-center">
                            <button
                                className="btn btn-success px-3 my-3"
                                style={{ backgroundColor: color_2 }}
                                onClick={applyCoupon}
                                type="button"
                            >
                                احصل علي الخصم
                            </button>
                        </div>
                    )}
                </form>
            </Modal.Body>
        </Modal>
    );
}

export default SendToWhatsapp;
