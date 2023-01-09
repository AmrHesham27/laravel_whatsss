import React, { useState } from "react";
import { useSelector, useDispatch } from "react-redux";
import { cartActions } from "../redux/cart";

function sizeOptions() {
    const dispatch = useDispatch()
    const product = useSelector(state => state.product)

    const [price, setPrice] = useState()
    const [size, setSize] = useState()

    const addToCart = () => {
        let newProduct = {...product.value, price, name: `${product.value['name']} - ${size}`}
        dispatch(cartActions.addProduct(newProduct))
    }

    return (
        <div
            className="modal fade"
            id="size_options"
            tabIndex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div className="modal-dialog" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <button
                            type="button"
                            className="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <div className="collapse-item">
                            <button className="collapse-button" type="button">
                                <div className="w-100 d-flex justify-content-end">
                                    <span>اختر الحجم</span>
                                </div>
                            </button>

                            <div>
                                <div
                                    className="card card-body options-row"
                                    style={{border: 'none', textAlign: 'flex-start'}}
                                >
                                    <div className="options-row">
                                        <span>
                                            <input
                                                type="radio"
                                                name="size"
                                                id="html"
                                                value="HTML"
                                                onChange={
                                                    () => {
                                                        setPrice(product['value'].l)
                                                        setSize('كبير')
                                                    }
                                                }
                                            />
                                            <label htmlFor="html" className="mx-1">
                                                {product['value'].l} - كبير 
                                            </label>
                                        </span>
                                        <span>
                                            <input
                                                type="radio"
                                                name="size"
                                                id="css"
                                                value="CSS"
                                                onChange={
                                                    () => {
                                                        setPrice(product['value'].m)
                                                        setSize('متوسط')
                                                    }
                                                }
                                            />
                                            <label htmlFor="css" className="mx-1">
                                                {product['value'].m} - وسط 
                                            </label>
                                        </span>
                                        <span>
                                            <input
                                                type="radio"
                                                name="size"
                                                id="javascript"
                                                value="JavaScript"
                                                onChange={
                                                    () => {
                                                        setPrice(product['value'].s)
                                                        setSize('صغير')
                                                    }
                                                }
                                            />
                                            <label htmlFor="javascript" className="mx-1">
                                                {product['value'].s} - صغير 
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="d-flex justify-content-center">
                            <button 
                                className="btn btn-success px-3 my-2"
                                onClick={addToCart}
                                data-dismiss="modal"
                            >
                                اضف الي العربه
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default sizeOptions;
