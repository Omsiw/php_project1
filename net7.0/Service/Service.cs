using ApiForPhoto.Abstract;
using ApiForPhoto.Model;
using Dapper;
using System.Data.SqlClient;
using static System.Runtime.InteropServices.JavaScript.JSType;

namespace ApiForPhoto.Service
{
    public class PostgreService : IService
    {
        private string conStr = "host=postgres port=5432 dbname=laravel user=postgres password=xxxxxxx connect_timeout=10 sslmode=prefer";
        private string table;

        public ImageResponce GetImage(int id)
        {
            using (SqlConnection con = new SqlConnection(conStr))
            {
                string path = con.Query<string>($"select image_path from {table} where id = {id}").FirstOrDefault();

                if (path == null)
                    path = "no_image.jpg";

                return new ImageResponce { Id = id, Data = File.ReadAllBytes(path) };

            } 
        }

        public Result CreateImage(ImageResponce img, string dirName, string extension)
        {
            var files = Directory.GetFiles(dirName);
            string fileName;
            if (files.Length > 1)
            {
                var file = files.Last().Split(".")[0].Split("image").LastOrDefault();
                int num = file == null ? 0 : int.Parse(file);
                fileName = "image" + ++num;
            }
            else 
                fileName = "image1";

            try
            {
                using (SqlConnection con = new SqlConnection(conStr))
                {
                    var path = dirName + "/" + fileName + extension;
                    File.WriteAllBytes(path, img.Data);

                    con.Execute($"insert into {table} values ({path})");
                    return new Result { Success = true };
                }
            }
            catch (Exception ex)
            {
                return new Result { Success = false, Message = ex.Message };
            }
        }

        public Result DeleteImage(int id)
        {
            try
            {
                using (SqlConnection con = new SqlConnection(conStr))
                {
                    var path = con.Query<string>($"select image_path from {table} where id = {id}").FirstOrDefault();

                    File.Delete(path);

                    con.Execute($"delete from {table} where id = {id}");

                    return new Result { Success = true };
                }
            }
            catch (Exception ex)
            {
                return new Result { Success = false, Message = ex.Message };
            }
        }

        public Result EditImage(ImageResponce img)
        {
            try
            {
                using (SqlConnection con = new SqlConnection(conStr))
                {
                    var path = con.Query<string>($"select image_path from {table} where id = {img.Id}").FirstOrDefault();
                    File.WriteAllBytes(path, img.Data);
                    return new Result { Success = true };
                }
            }
            catch (Exception ex)
            {
                return new Result { Success = false, Message = ex.Message };
            }
        }

        public Result DeleteDirectory(string dirName)
        {
            try
            {
                var files = Directory.EnumerateFiles(dirName);
                foreach (var file in files)
                {
                    File.Delete(dirName + "/" + file);
                }
                Directory.Delete("");

                return new Result { Success = true };
            }
            catch (Exception ex)
            {
                return new Result { Success = false, Message = ex.Message };
            }
        }

        public void SetTable(string table)
        {
            this.table = table;
        }
    }
}
