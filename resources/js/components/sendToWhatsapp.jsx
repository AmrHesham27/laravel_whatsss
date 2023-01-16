import React from "react";

function sendToWhatsapp({ whatsapp, color_1, color_2 }) {
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
                                <label htmlFor="exampleInputEmail1">العنوان</label>
                                <input
                                    type="text"
                                    className="form-control text-right"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                    placeholder="ادخل عنوانك"
                                />
                            </div>
                            <div className="form-group mt-4">
                                <label htmlFor="exampleInputPassword1">
                                    طريقة الاستلام
                                </label>
                                <input
                                    type="text"
                                    className="form-control text-right"
                                    id="exampleInputPassword1"
                                    placeholder="طريقة الاستلام"
                                    value="توصيل"
                                />
                            </div>
                            <div className="d-flex justify-content-center">
                                <a 
                                    className="btn btn-success px-3 my-2"
                                    href={`https://wa.me/${whatsapp}/?text=${'kkk'}`}
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
