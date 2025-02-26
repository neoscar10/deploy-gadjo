<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
      <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
      <div class="flex flex-col md:flex-row gap-4">
        <div class="md:w-3/4">
          <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
            <table class="w-full">
              <thead>
                <tr>
                  <th class="text-left font-semibold">Product</th>
                  <th class="text-left font-semibold">Price</th>
                  <th class="text-left font-semibold">Quantity</th>
                  <th class="text-left font-semibold">Total</th>
                  <th class="text-left font-semibold">Remove</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cart_items as $item)
                <tr wire:key="{{$item['product_id']}}">
                  <td class="py-4">
                    <div class="flex items-center">
                      <img class="h-16 w-16 mr-4" src="{{url('storage', $item['image'])}}" alt="Product image">
                      <span class="font-semibold">{{$item['name']}}</span>
                    </div>
                  </td>
                  <td class="py-4">₦{{number_format($item['unit_amount'], 0)}}</td>
                  <td class="py-4">
                    <div class="flex items-center">
                        <!-- Decrease Button -->
                        <button wire:click='decreaseQty({{ $item["product_id"] }})' 
                                wire:loading.attr="disabled" 
                                wire:target="decreaseQty({{ $item['product_id'] }})" 
                                class="border border-gray-400 rounded-md py-2 px-4 mr-2 flex items-center justify-center relative w-10 h-10 
                                       transition duration-300 ease-in-out hover:bg-red-500 hover:text-white hover:border-red-700">
                            <span wire:loading.remove wire:target="decreaseQty({{ $item['product_id'] }})" class="w-6 h-6 flex items-center justify-center">-</span>
                            <span wire:loading wire:target="decreaseQty({{ $item['product_id'] }})" class="absolute w-6 h-6 flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 text-gray-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </span>
                        </button>
                
                        <!-- Quantity Display -->
                        <span class="text-center w-8">{{ $item["quantity"] }}</span>
                
                        <!-- Increase Button -->
                        <button wire:click='increaseQty({{ $item["product_id"] }})' 
                                wire:loading.attr="disabled" 
                                wire:target="increaseQty({{ $item['product_id'] }})" 
                                class="border border-gray-400 rounded-md py-2 px-4 ml-2 flex items-center justify-center relative w-10 h-10 
                                       transition duration-300 ease-in-out hover:bg-green-500 hover:text-white hover:border-green-700">
                            <span wire:loading.remove wire:target="increaseQty({{ $item['product_id'] }})" class="w-6 h-6 flex items-center justify-center">+</span>
                            <span wire:loading wire:target="increaseQty({{ $item['product_id'] }})" class="absolute w-6 h-6 flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 text-gray-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </td>
                
                
                  <td class="py-4">₦{{number_format($item['total_amount'], 0)}}</td>
                  <td>
                    <button wire:click="removeItem({{ $item['product_id'] }})"
                      class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 flex items-center gap-2 justify-center relative min-h-[36px] min-w-[80px]">

                      <!-- Default Text (Hidden when loading) -->
                      <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Remove</span> 

                      <!-- Styled Loading Animation (Shown while processing) -->
                      <span wire:loading wire:target="removeItem({{ $item['product_id'] }})" class="flex items-center gap-2">
                        
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                       </svg>
                      </span>

                  </button>

                </td>
                
                </tr>
                @empty
                    <td colspan="5" class="text-center py-4 text-4xl text-slate-500 font-semibold">No items available in cart!</td>
                @endforelse
                <!-- More product rows -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="md:w-1/4">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold mb-4">Summary</h2>
            <div class="flex justify-between mb-2">
              <span>Subtotal</span>
              <span>₦{{number_format($grand_total, 0)}}</span>
            </div>
            {{-- <div class="flex justify-between mb-2">
              <span>Taxes</span>
              <span>$1.99</span>
            </div> --}}
            <div class="flex justify-between mb-2">
              <span>Shipping</span>
              <span>₦{{number_format(0, 2)}}</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between mb-2">
              <span class="font-semibold">Total</span>
              <span class="font-semibold">₦{{number_format($grand_total, 0)}}</span>
            </div>
            @if ($cart_items)
            <a href="/checkout" 
            wire:navigate
            x-data="{ loading: false }" 
            @click="loading = true" 
            class="bg-orange-500 text-white block text-center py-2 px-4 rounded-lg mt-4 w-full relative">
            
            <span x-show="!loading">Checkout</span>
            
            <span x-show="loading" class="flex justify-center items-center">
               <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
               </svg>
            </span>
         </a>
         
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>