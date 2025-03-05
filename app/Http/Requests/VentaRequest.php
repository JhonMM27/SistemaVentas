<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productos' => 'required|array|min:1',
            'productos.*' => 'exists:productos,id',
            'cantidades' => 'required|array|min:1',
            'cantidades.*' => 'required|integer|min:1',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
            'tipo_comprobante' => 'required|in:boleta,factura',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $productos = $this->input('productos');
            $cantidades = $this->input('cantidades');

            foreach ($productos as $index => $productoId) {
                $producto = \App\Models\Producto::find($productoId);
                $cantidad = $cantidades[$index];

                if ($producto && $producto->stock < $cantidad) {
                    $validator->errors()->add(
                        "cantidades.$index",
                        "No hay suficiente stock para el producto '{$producto->nombre}'. Stock disponible: {$producto->stock}"
                    );
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'productos.required' => 'El campo Productos es obligatorio',
            'productos.array' => 'El campo Productos debe de ser un arreglo',
            'productos.max' => 'El campo Productos debe de tener al menos un producto',
            'productos.*.exists' => 'El producto seleccionado no existe',
            'cantidades.required' => 'El campo Cantidades es obligatorio',
            'cantidades.array' => 'El campo Cantidades debe de ser un arreglo',
            'cantidades.min' => 'El campo Cantidades debe de tener al menos una cantidad',
            'cantidades.*.required' => 'El campo Cantidades es obligatorio',
            'cantidades.*.integer' => 'El campo Cantidades debe de ser un número entero',
            'cantidades.*.min' => 'El campo Cantidades debe de ser al menos 1',
            'metodo_pago.required' => 'El campo Método de Pago es obligatorio',
            'metodo_pago.in' => 'El campo Método de Pago debe de ser efectivo, tarjeta o transferencia',
            'tipo_comprobante.required' => 'El campo Tipo de Comprobante es obligatorio',
            'tipo_comprobante.in' => 'El campo Tipo de Comprobante debe de ser boleta o factura',
        ];
    }


}
