// withHooks
import { memo, useEffect, useState } from 'react';

import navigation from 'esoftplay/modules/lib/navigation';
import React from 'react';
import { ActivityIndicator, Image, Pressable, Text, View } from 'react-native';
import { Auth } from '../auth/login';
import { FlatList, ScrollView } from 'react-native-gesture-handler';
import { UtilsDatepicker } from 'esoftplay/cache/utils/datepicker/import';
import useSafeState from 'esoftplay/state';
import moment from 'esoftplay/moment';
import Icon from '@ant-design/icons/lib/components/Icon';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';


export interface TeacherHomeArgs {

}
export interface TeacherHomeProps {

}
interface Product {
  id: number;
  title: string;
  description: string;
  price: number;
}
function m(props: TeacherHomeProps): any {

  const logout = () => {
    Auth.reset()
    navigation.navigate('auth/login')
  }
  const [tanggalDipilih, setTanggalDipilih] = useSafeState('')

  const jadwal = [

    {
      'nama kelas': 'kelas 8A',
      'jam': '07.00-08.00',
      'jamke': 'jam ke 1 -jam ke 2',
      'jumlah siswa': '30/30',
      'materi': 'Matematika',
      'color': 'green'
    },
    {
      'nama kelas': 'kelas 8B',
      'jam': '08.00-09.00',
      'jamke': 'jam ke 3 -jam ke 4',
      'materi': 'Fisika',
      'jumlah siswa': '00/30',
      'color': 'red'
    },
    {
      'nama kelas': 'kelas 8C',
      'jam': '09.00-10.00',
      'jamke': 'jam ke 5 -jam ke 6',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    },
    {
      'nama kelas': 'kelas 8D',
      'jam': '10.00-11.00',
      'jamke': 'jam ke 7 -jam ke 8',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    },
    {
      'nama kelas': 'kelas 8E',
      'jam': '11.00-12.00',
      'jamke': 'jam ke 9 -jam ke 10',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    }
    

  ]

  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | undefined>();
  const [response, setResponse] = useState<{ result: Product[] } | undefined>();
  const [products, setProducts] = useState<Product[]>([]);

useEffect(() => {

    
		// const url:string="http://api.school.lc/"
    
    // new LibCurl(url,null,(result,msg)=>{ 
		// 	console.log(result)
		// },(err)=>{
		// 	console.log("eror")
		// })

		  a()


  }, [])

	const a =()=>{
		const url:string="http://api.school.lc/"
    console.log(url)


    new LibCurl(url,null,(result,msg)=>{ 
			console.log('oke',{result})
		},(err)=>{
			console.log("eror",err)
		})
		// new LibCurl()
		console.log(1)
new LibCurl().custom('http://api.school.lc',null,(res)=>{
      console.log("resullt",{res})
})
		console.log(2)

		// new LibCurl().custom(url, null, (res) => {
    //   console.log("resullt",{res})
    // }, 1)


		fetch(url).then((v)=>{
			console.log('ok')
		}).catch((e)=>{
			console.log('er')
		})
    
	}


  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10 }}>

      <FlatList data={jadwal}
      style={{height:'auto',}}
        showsVerticalScrollIndicator={false}
        ListHeaderComponent={
          <ScrollView showsVerticalScrollIndicator={false}>
            <Pressable onPress={() => a()} style={{ width: 80, height: 40, backgroundColor: 'red', borderRadius: 10, justifyContent: 'center', alignContent: 'center', alignSelf: 'flex-end', marginTop: 30 }}>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center', }}>get api</Text>
            </Pressable>
            {/* welcome card */}
            <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', marginTop: 10 }}>
              <Image source={require('../../assets/anies.png')} style={{ width: 100, height: 100, borderRadius: 40, marginRight: 20 }} />
              <View style={{ alignSelf: 'center' }}>
                <Text style={{ fontSize: 20, fontWeight: 'normal', color: 'black' }}>Selamat datang</Text>
                <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black' }}>Anies Rasyid Baswedan</Text>
              </View>
            </View>
            {/* schadule */}
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Jadwal Mengajar</Text>

          </ScrollView>
        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item, index }) => {
            return (
                                        // LibNavigation.navigate('teacher/attandence', { data: {data} });
            <Pressable onPress={()=>LibNavigation.navigate('teacher/attandence',{data:item['nama kelas']})} style={{ backgroundColor: item['color'], borderRadius: 10, marginTop: 10, flexDirection:'row', }}>

              <View style={{ backgroundColor: 'white',  padding: 10 ,marginLeft:30,width:'80%',opacity:0.7}}>
                
                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item['nama kelas']} | {item['materi']}</Text>
                  <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: item['color'], justifyContent: 'center', alignItems: 'center' ,paddingHorizontal:10}}>

                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item['jumlah siswa']}</Text>
                  </View>
                </View>

                <View style={{ height: 30,   }} />
                <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item['jamke']}</Text>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item['jam']}</Text>
                </View>
              </View>

              <LibIcon.AntDesign name="right" size={25} color="white" style={{ alignSelf:'center', marginLeft:10}} />
             
            </Pressable>
            )
          }
        } />


    </View>
  )
}
export default memo(m);